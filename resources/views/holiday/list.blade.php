@extends('layouts.app', [
    'pageTitle' => 'Holiday'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                @can('create', App\Holiday::class)
                    <div class="card-header border-bottom text-right">
                        <a href="/holidays/create" class="btn btn-primary">
                            <i class="fa fa-plus mr-2"></i>
                            Add Holiday
                        </a>
                    </div>
                @endcan
                <div class="card-body">
                    <holiday-calender></holiday-calender>
                </div>
            </div>
        </div>
    </div>
@endsection
