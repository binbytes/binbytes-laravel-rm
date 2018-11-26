@component('mail::message')

hello your salary has been paid.


Basic Salary: {{ $salary->base_salary }}<br>
PF: {{ $salary->pf }}<br>
TDS: {{ $salary->tds }}<br>
Bonus: {{ $salary->bonus }}<br>
Deduction: {{ $salary->penalty }}<br>
Paid Amount: {{ $salary->paid_amount }}


@component('mail::button', ['url' => $url ])
View Salaries
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
