@extends('layouts.app', [
    'pageTitle' => 'Leave'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                <div class="card-header border-bottom text-right">
                    <a href="/leaves/create" class="btn btn-primary">
                        <i class="fa fa-plus mr-2"></i>
                        Add Leave
                    </a>
                </div>
                <div class="card-body">
                    <leave-calender></leave-calender>
                </div>
            </div>
        </div>
    </div>
@endsection

