<?php

namespace App\Imports;

use App\Account;
use Carbon\Carbon;
use App\Transaction;
use App\User;
use App\Salary;
use App\Events\SalaryPaid;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class TransactionImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (! method_exists($this, $this->account->bank_name)) {
            return;
        }

        $data = $this->{$this->account->bank_name}($row);

        if (! $data) {
            return;
        }

        return new Transaction($data);
    }

    public function AXIS($row)
    {
        if (! isset($row['tran_date']) || ! strtotime($row['tran_date']) || ! isset($row['bal'])) {
            return;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => $row['srl_no'],
            'date' => Carbon::createFromFormat('d-m-Y', $row['tran_date']),
            'reference' => $row['chqno'],
            'description' => $row['particulars'],
            'debit_amount' => amountStrToFloat($row['dr']),
            'credit_amount' => amountStrToFloat($row['cr']),
            'closing_balance' => amountStrToFloat($row['bal']),
        ];
    }

    public function HDFC($row)
    {
        if (! isset($row['date']) || ! validateDate($row['date'], $format = 'd/m/y') || ! isset($row['closing_balance'])) {
            return;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => 1,
            'date' => Carbon::createFromFormat('d/m/y', $row['date']),
            'reference' => $row['chqrefno'],
            'description' => $row['narration'],
            'debit_amount' => amountStrToFloat($row['withdrawal_amt']),
            'credit_amount' => amountStrToFloat($row['deposit_amt']),
            'closing_balance' => amountStrToFloat($row['closing_balance']),
        ];
    }

    public function SBI($row)
    {
        if (! isset($row['txn_date']) || ! strtotime($row['txn_date']) || ! isset($row['balance'])) {
            return;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => 1,
            'date' => Carbon::createFromFormat('j M Y', $row['txn_date'])->toDateTimeString(),
            'reference' => $row['ref_nocheque_no'],
            'description' => $row['description'],
            'debit_amount' => amountStrToFloat($row['debit']),
            'credit_amount' => amountStrToFloat($row['credit']),
            'closing_balance' => amountStrToFloat($row['balance']),
        ];
    }

    public function YES($row)
    {
        if (! isset($row['txn_date']) || ! isset($row['running_balance'])) {
            return;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => 1,
            'date' => Carbon::createFromFormat('d/m/Y H:i:s', trim($row['txn_date'], " ' ")),
            'reference' => $row['reference_no'],
            'description' => $row['description'],
            'debit_amount' => amountStrToFloat($row['debit_amount']),
            'credit_amount' => amountStrToFloat($row['credit_amount']),
            'closing_balance' => amountStrToFloat($row['running_balance']),
        ];
    }

    public function BOB($row)
    {
        if (! isset($row['date']) || ! validateDate($row['date'], $format = 'd/m/y') || ! isset($row['balance'])) {
            return;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => $row['sno'],
            'date' =>  Carbon::createFromFormat('d/m/y', $row['date']),
            'reference' => $row['chequeno'],
            'description' => $row['description'],
            'debit_amount' => amountStrToFloat($row['debit']),
            'credit_amount' => amountStrToFloat($row['credit']),
            'closing_balance' => amountStrToFloat($row['balance']),
        ];
    }

    public function ICICI($row)
    {
        if (! isset($row['value_date'])|| ! validateDate($row['value_date'], $format = 'd/m/Y') || ! isset($row['available_balanceinr'])) {
            return;
        }

        $cr=0;
        $dr=0;
        $description = $row['description'];
        $date = Carbon::createFromFormat('d/m/Y', $row['value_date']);

        if($row['crdr'] == 'DR') {
            $dr = amountStrToFloat($row['transaction_amountinr']);
        } else {
            $cr = amountStrToFloat($row['transaction_amountinr']);
        }

        if($this->account->company_account) {
            User::all()->each(function ($user) use ($description, $dr, $date) {
                $name = "{$user->first_name}{$user->last_name}";
                $contains = Str::contains($description, $name);
                if($contains && $dr > 0) {
                    $data = [
                        'user_id' => $user->id,
                        'base_salary' => $user->base_salary,
                        'paid_for' => $date,
                        'pf' => $user->tds_amount ? (int) $user->tds_amount : 0,
                        'tds' => $user->professional_tax_amount ? (int) $user->professional_tax_amount : 0,
                        'paid_amount' => $dr,
                        'payment_method' => 'NetBanking',
                    ];

                    $salary = Salary::create($data);

                    event(new SalaryPaid($salary));
                }
            });
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => $row['no'],
            'date' =>  Carbon::createFromFormat('d/m/Y', $row['value_date']),
            'reference' => $row['chequeno'],
            'description' => $row['description'],
            'debit_amount' => $dr,
            'credit_amount' => $cr,
            'closing_balance' => amountStrToFloat($row['available_balanceinr']),
        ];
    }

    public function headingRow(): int
    {
        return $this->account->statement_starting_line;
    }

    public function getCsvSettings() : array
    {
        $delimiter = $this->account->customDelimiter();

        if ($delimiter) {
            return [
                'delimiter' => "\t",
            ];
        }

        return [];
    }
}
