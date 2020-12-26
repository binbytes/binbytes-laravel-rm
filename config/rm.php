<?php

return [
    'broadcast_notification' => env('NOTIFICATION_BROADCAST') == 'true',
    'company' => [
        'name' => env('COMPANY_NAME', 'BinBytes'),
        'email' => env('COMPANY_MAIL', 'info@binbytes.com'),
    ],
    'admin' => [
        'kanetiya@gmail.com',
    ],
    'payment_methods' => [
        'Cheque' => 'Cheque',
        'Cash' => 'Cash',
        'Online Transaction' => 'Online Transaction',
    ],
    'banks' => [
        'HDFC' => 'HDFC',
        'AXIS' => 'AXIS',
        'YES' => 'YES',
        'SBI' => 'SBI',
        'BOB' => 'BOB',
        'ICICI' => 'ICICI',
    ],
    'target_models' => [
        '\App\User' => 'User',
        '\App\Client' => 'Client',
        '\App\Project' => 'Project',
    ],
    'transaction_type' => [
        'both' => 'Both',
        'credit' => 'Credit',
        'debit' => 'Debit',
    ],
    'roles' => [
        'admin' => 'Admin',
        'employee' => 'Employee',
        'accountant' => 'Accountant',
    ],

    'ping_timeout' => 5 * 60, //second format.
];
