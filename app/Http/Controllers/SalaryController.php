<?php

namespace App\Http\Controllers;

use App\User;
use App\Leave;
use App\Salary;
use App\Events\SalaryPaid;
use Illuminate\Http\Request;
use App\Http\Requests\SalaryRequest;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('index', Salary::class);

        $salaries = Salary::with('user')
                    ->whereMonth('paid_for', now()->month)
                    ->get();
        $date = now()->format('F-Y');
        $month = now()->month;
        $year = now()->year;

        return view('salary.paid-list', compact('salaries', 'date', 'month', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usersIds = $request->users;
        $date = today()->format('Y').'-'.request('month').'-'.today()->format('d');

        User::whereIn('id', $usersIds)->get()->each(function ($user) use ($date) {
            $tds = $user->tds_amount ? (int) $user->tds_amount : 0;
            $pf = $user->professional_tax_amount ? (int) $user->professional_tax_amount : 0;

            $data = [
                'user_id' => $user->id,
                'base_salary' => $user->base_salary,
                'paid_for' => $date,
                'pf' => $pf,
                'tds' => $tds,
                'paid_amount' => (((int) $user->base_salary) - ($tds + $pf)),
                'payment_method' => request('payment_method'),
            ];

            $salary = Salary::create($data);

            event(new SalaryPaid($salary));
        });

        return redirect('/salary');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('show', [Salary::class, $user]);

        $salaries = Salary::where('user_id', $id)->latest('paid_for')->get();

        return view('salary.show', compact('salaries', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return user
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update', Salary::class);

        $leaves = Leave::with('user')
                    ->where('user_id', $id)
                    ->where('start_date', today()->month)
                    ->get();

        $user = User::findOrFail($id);

        return view('salary.update', compact('user', 'leaves'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SalaryRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $date = today()->format('Y').'-'.request('month').'-'.today()->format('d');

        $tds = $user->tds_amount ? (int) $user->tds_amount : 0;
        $pf = $user->professional_tax_amount ? (int) $user->professional_tax_amount : 0;

        $deduction = $tds + $pf + request('penalty');

        $paidSalary = (request('base_salary') - $deduction);

        $data = [
            'user_id' => $user->id,
            'base_salary' => request('base_salary'),
            'paid_amount' => ($paidSalary + request('bonus')),
            'paid_for' => $date,
            'pf' => $pf,
            'tds' => $tds,
            'bonus' => request('bonus'),
            'penalty' => request('penalty'),
            'payment_method' => request('payment_method'),
            'paid_note' => request('paid_note'),
            'general_note' => request('general_note'),
        ];

        $salary = Salary::create($data);

        event(new SalaryPaid($salary));

        return redirect('/salary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param $month
     * @param $year
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function filter($month, $year)
    {
        $this->authorize('paidSalary', Salary::class);

        $date = $month.'-'.$year;

        $salaries = Salary::with('user')->whereMonth('paid_for', $date)->get();

        $date = date('F-Y', mktime(0, 0, 0, $month + 1, 0, $year));

        return view('salary.paid-list', compact('salaries', 'date', 'month', 'year'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function view($month = null)
    {
        $this->authorize('view', Salary::class);

        if ($month == null) {
            $month = today()->format('m');
            $date = today()->format('m-Y');
        } else {
            $date = $month.'-'.today()->format('Y');
        }

        $salariesUserIds = Salary::with('user')->whereMonth('paid_for', $date)->pluck('user_id');

        $users = User::whereNotIn('id', $salariesUserIds)
                    ->whereExcludeFromSalary(false)
                    ->get();

        return view('salary.list', compact('users', 'month'));
    }

    public function downloadPayslip($id)
    {
        $salary = Salary::with('user')->findOrFail($id);

        return $salary->paySlipPDF()->download($salary->paySlipFileName());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payslip($id)
    {
        $salary = Salary::with('user')->findOrFail($id);

        return view('letter.payslip', compact('salary'));
    }

    public function downloadPaidSalary($month, $year)
    {
        $this->authorize('paidSalary', Salary::class);

        $date = $month.'-'.$year;

        $salaries = Salary::with('user')->whereMonth('paid_for', $date)->get();

        $date = date('F-Y', mktime(0, 0, 0, $month + 1, 0, $year));

        $pdf = \PDF::loadView('letter.paidSalary', [
            'salaries' => $salaries,
            'date' => $date,
        ]);

        return $pdf->setPaper('a4', 'landscape')->download($date.'.pdf');
    }
}
