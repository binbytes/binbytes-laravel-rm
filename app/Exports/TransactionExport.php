<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromCollection, WithHeadings
{
    use Exportable;

    public $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function headings(): array
    {
        return [
            '#',
            'Date',
            'description',
            'reference',
            'credit_amount',
            'debit_amount',
            'closing_balance',
            'note'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return $this->transactions;
    }
}
