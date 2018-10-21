@extends('layouts.app', [
    'pageTitle' => 'Dashboard'
])

@section('content')
<div class="container pg-dashboard">
    <div class="row justify-content-center">
        @include('dashboard._today')
        @include('dashboard._week', compact('weekAttendances'))
    </div>
</div>
@endsection
