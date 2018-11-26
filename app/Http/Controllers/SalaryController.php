<?php

namespace App\Http\Controllers;

use App\Events\SalaryPaid;
use App\Http\Requests\SalaryRequest;
use App\Leave;
use App\Salary;
use App\User;
use Illuminate\Http\Request;
use PDF;

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
        if($this->authorize('index', Salary::class)) {
            $salaries = Salary::with('user')->whereMonth('paid_for', now()->month)->get();
            $date = now()->format('F-Y');
            $month = now()->month;
            $year = now()->year;

            return view('salary.paid-list', compact( 'salaries', 'date', 'month', 'year'));
        }
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

        User::whereIn('id', $usersIds)->get()->each(function ($user) {
            $pf = 200;
            $tds = 200;

            $deduction = $tds + $pf;
            $paidSalary = (($user->base_salary) - $deduction);
            $data = [
                'user_id' => $user->id,
                'base_salary' => $user->base_salary,
                'paid_for' => today(),
                'pf' => $pf,
                'tds' => $tds,
                'paid_amount' => $paidSalary,
                'payment_method' => request('payment_method')
            ];

            $salary = Salary::create($data);

            PDF::loadView('letter.payslip', compact('salary'))
                ->save(storage_path('app/public/download/'. $salary->paySlipFileName()));

            event(new SalaryPaid($salary, $salary->paySlipFileName()));


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

        if($this->authorize('show', [Salary::class, $user])) {

            $salaries = Salary::where('user_id', $id)->latest('paid_for')->get();

            return view('salary.show', compact('salaries', 'user'));
        }
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
        if($this->authorize('update', Salary::class)) {

            $leaves = Leave::with('user')
                        ->where('user_id', $id)
                        ->where('start_date', today()->month)
                        ->get();

            $user = User::findOrFail($id);

            return view('salary.update', compact('user', 'leaves'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SalaryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryRequest $request, $id)
    {
        $pf = 200;
        $tds = 200;
        $deduction = $tds + $pf + request('penalty');

        $paidSalary = (request('base_salary') - $deduction);

        $paidSalary = ($paidSalary + request('bonus'));

        $data =[
            'user_id' => $id,
            'base_salary' => request('base_salary'),
            'paid_amount' => $paidSalary,
            'paid_for' => today(),
            'pf' => $pf,
            'tds' => $tds,
            'bonus' => request('bonus'),
            'penalty' => request('penalty'),
            'payment_method' => request('payment_method'),
            'paid_note' => request('paid_note'),
            'general_note' => request('general_note')
        ];

        $salary = Salary::create($data);

        PDF::loadView('letter.payslip', compact('salary'))
            ->save(storage_path('app/public/download/'. $salary->paySlipFileName()));

        event(new SalaryPaid($salary, $salary->paySlipFileName()));

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
    public function filter($month , $year)
    {
        if($this->authorize('paidSalary', Salary::class)) {
            $date = $month . "-" . $year;

            $salaries = Salary::with('user')->whereMonth('paid_for', $date)->get();

            $date = date("F-Y", mktime(0, 0, 0, $month+1, 0, $year));

            return view('salary.paid-list', compact( 'salaries', 'date', 'month', 'year'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function view()
    {
        if($this->authorize('view', Salary::class)) {
            $salariesUserIds = Salary::paidForMonth()->pluck('user_id');

            $users = User::whereNotIn('id', $salariesUserIds)->get();

            return view('salary.list', compact('users', 'salary'));
        }
    }

    public function download($id)
    {
        $salary = Salary::with('user')->findOrFail($id);

        $pdf = PDF::loadView('letter.payslip', compact('salary'));

        return $pdf->download($salary->paySlipFileName());
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
}
