@extends('layouts.app', [
    'pageTitle' => 'Dashboard'
])

@section('content')
<div class="pg-dashboard">
    @admin
        <div class="row mb-4">
            <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <a href="/users">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-primary text-uppercase">Users</span>
                                    <h6 class="stats-small__value count my-3">{{ count($users) }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <a href="/projects">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-success text-uppercase">Projects</span>
                                    <h6 class="stats-small__value count my-3">{{ count($projects) }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <a href="/clients">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-fiord-blue text-uppercase">Clients</span>
                                    <h6 class="stats-small__value count my-3">{{ count($clients) }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @include('dashboard._user')
        </div>
    @else
        <div class="row">
            @include('dashboard._today')
            <div class="col-md-8">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <div class="row mx-2">
                            <h6 class="mb-0">Weekly Performance Report</h6>
                            <a href="{{ route('day-attendance', [auth()->id(), today()->format('Y-m-d'), today()->format('Y-m-d')]) }}" class="btn btn-primary ml-auto">This week</a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <canvas height="130" id="myChart" class="mt-3"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endadmin
</div>
@endsection

@notAdmin
    @include('shared.chart')
@endadmin