<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionExport implements FromCollection, WithHeadings, ShouldAutoSize
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
            'ID',
            'Date',
            'Description',
            'Reference',
            'Credit Amount',
            'Debit Amount',
            'Closing Balance',
            'Note',
            'Invoice',
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
