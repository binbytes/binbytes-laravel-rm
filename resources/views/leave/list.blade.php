@extends('layouts.app', [
    'pageTitle' => 'Leave'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                <div class="card-body">
                    <leave-calender can-create="{{ \Gate::allows('create', \App\Leave::class) == true }}"></leave-calender>
                </div>
            </div>
        </div>
    </div>
@endsection

