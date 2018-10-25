@component('mail::message')
# Holiday Alert!

We have a Holiday for {{ $holiday->title }} from {{ $holiday->start_date->toDateString() }} To {{ $holiday->end_date->toDateString() }}

{{ $holiday->description }}

@component('mail::button', ['url' => $url])
    View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
