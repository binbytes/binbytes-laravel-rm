@component('mail::message')
Your leave request has been {{ $leave->approval_status }}

@component('mail::button', ['url' => $url])
View Detail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
