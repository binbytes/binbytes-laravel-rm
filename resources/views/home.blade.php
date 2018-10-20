@extends('layouts.app', [
    'pageTitle' => 'Dashboard'
])

@section('content')
<div class="container pg-dashboard">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header border-bottom pb-0">
                    <h6 class="font-weight-bold">Today</h6>
                </div>
                <div class="card-body">
                    <timer :initial-time="{{ auth()->user()->today_attendance->totaltime }}"></timer>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
