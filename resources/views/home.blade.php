@extends('layouts.app', [
    'pageTitle' => 'Dashboard'
])

@section('content')
<div class="pg-dashboard">
    @if(auth()->user()->isAdmin())
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <a href="/users">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center">
                                <div class="text-info">
                                    <i class="fa fa-users fa-3x"></i>
                                </div>
                                <div class="ml-5">
                                    <div class="font-weight-bold text-black">{{ count($users) }}</div>
                                    <span class="text-muted">Users</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <a href="/projects">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center">
                                <div class="text-success">
                                    <i class="fa fa-tasks fa-3x"></i>
                                </div>
                                <div class="ml-5">
                                    <div class="font-weight-bold text-black">{{ count($projects) }}</div>
                                    <span class="text-muted">Projects</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <a href="/clients">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center">
                                <div class="text-fiord-blue">
                                    <i class="fas fa-user fa-3x"></i>
                                </div>
                                <div class="ml-5">
                                    <div class="font-weight-bold text-black">{{ count($clients) }}</div>
                                    <span class="text-muted">Clients</span>
                                </div>
                            </div>
                        </div>
                    </a>
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
    @endif
</div>
@endsection

@include('shared.chart')
