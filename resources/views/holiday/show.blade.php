@extends('layouts.app', [
    'subTitle' => 'Holiday',
    'pageTitle' => 'View Holiday'
])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    <h4 class="mb-0">{{ $holiday->title }}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row px-3">
                        <p> {{ $holiday->description }} </p>
                    </div>
                    <div class="row">
                        <div class="col-1 pr-0">
                            <h6>Duration:</h6>
                        </div>
                        <div class="col-10">
                            <span class="text-muted">{{ $holiday->start_date->toDateString() }}
                                {{ $holiday->start_date_partial_hours ? '('.$holiday->start_date_partial_hours. 'hours)' : ''}}
                                <strong> To </strong>
                                {{ $holiday->end_date->toDateString() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection