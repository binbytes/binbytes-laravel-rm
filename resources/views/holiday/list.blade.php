@extends('layouts.app', [
    'pageTitle' => 'Holiday'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                <div class="card-body">
                    <holiday-calender can-create="{{ \Gate::allows('create', \App\Holiday::class) == true }}"></holiday-calender>
                </div>
            </div>
        </div>
    </div>
@endsection
