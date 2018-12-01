<?php

namespace App\Imports;

use App\Account;
use App\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
        if(!method_exists($this, $this->account->bank_name)) {
            return;
        }

        $data = $this->{$this->account->bank_name}($row);

        if(!$data) {
            return;
        }

        return new Transaction($data);
    }

    public function AXIS($row)
    {
        if (!isset($row['tran_date']) || !strtotime($row['tran_date']) || !isset($row['bal'])) {
            return null;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => $row['srl_no'],
            'date' => Carbon::createFromFormat('d-m-Y', $row['tran_date']),
            'reference' => $row['chqno'],
            'description' => $row['particulars'],
            'debit_amount' => amountStrToFloat($row['dr']),
            'credit_amount' => amountStrToFloat($row['cr']),
            'closing_balance' => amountStrToFloat($row['bal'])
        ];
    }

    public function HDFC($row)
    {
        if (!isset($row['date']) || !strtotime($row['date']) || !isset($row['closing_balance'])) {
            return null;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => 1,
            'date' => Carbon::createFromFormat('d/m/y', $row['date']),
            'reference' => $row['chqrefno'],
            'description' => $row['narration'],
            'debit_amount' => amountStrToFloat($row['withdrawal_amt']),
            'credit_amount' => amountStrToFloat($row['deposit_amt']),
            'closing_balance' => amountStrToFloat($row['closing_balance'])
        ];
    }

    public function SBI($row)
    {
        if (!isset($row['txn_date']) || !strtotime($row['txn_date']) || !isset($row['balance'])) {
            return null;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => 1,
            'date' => Carbon::createFromFormat('j M Y', $row['txn_date'])->toDateTimeString(),
            'reference' => $row['ref_nocheque_no'],
            'description' => $row['description'],
            'debit_amount' => amountStrToFloat($row['debit']),
            'credit_amount' => amountStrToFloat($row['credit']),
            'closing_balance' => amountStrToFloat($row['balance'])
        ];
    }

    public function YES($row)
    {
        if (!isset($row['txn_date']) || !strtotime(trim($row['txn_date'], "'")) || !isset($row['running_balance'])) {
            return null;
        }

        return [
            'account_id' => $this->account->id,
            'sequence_number' => 1,
            'date' => Carbon::createFromFormat('d/m/Y H:i:s', trim($row['txn_date'], " ' ")),
            'reference' => $row['reference_no'],
            'description' => $row['description'],
            'debit_amount' => amountStrToFloat($row['debit_amount']),
            'credit_amount' => amountStrToFloat($row['credit_amount']),
            'closing_balance' => amountStrToFloat($row['running_balance'])
        ];
    }

    public function headingRow(): int
    {
        return $this->account->statement_starting_line;
    }

    public function getCsvSettings() : array
    {
        $delimiter = $this->account->customDelimiter();

        if($delimiter) {
            return [
                'delimiter' => "\t"
            ];
        }

        return [];
    }
}
