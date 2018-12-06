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
    'target_models' => [
        '\App\User' => 'User',
        '\App\Client' => 'Client',
        '\App\Project' => 'Project'
    ],
    'transaction_type' => [
        'both' => 'Both',
        'credit' => 'Credit',
        'debit' => 'Debit'
    ]
];