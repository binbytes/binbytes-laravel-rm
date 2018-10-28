@component('mail::message')
# Leave Request

{{ $leave->user->name }} have requested for Leave from {{ $leave->start_date->toDateString() }} to {{ $leave->end_date->toDateString() }}

@component('mail::button', ['url' => $url])
View Detail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
