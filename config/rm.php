<?php

return [
    'company' => [
        'name' => env('COMPANY_NAME', 'BinBytes'),
        'email' => env('COMPANY_MAIL', 'info@binbytes.com')
    ],
    'admin' => [
        'kanetiya@gmail.com'
    ],
    'payment_methods' => [
        'cheque' => 'Cheque',
        'cash' => 'Cash',
        'online transaction' => 'Online Transaction'
    ],
    'banks' => [
        'HDFC' => 'HDFC',
        'AXIS' => 'AXIS',
        'YES' => 'YES',
        'SBI' => 'SBI'
    ],
    'transaction_types' => [
        'income' => 'Income',
        'expense' => 'Expense',
        'salary' => 'Salary',
        'send_to_family' => 'Family transfer',
        'internal' => 'Internal Account transfer', // transfer between own account
        'other' => 'Other'
    ]
];