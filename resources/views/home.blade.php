@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="timer-block">
                        <timer :initial-time="{{ auth()->user()->today_attendance->totaltime }}"></timer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
