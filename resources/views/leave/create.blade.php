@extends('layouts.app', [
    'subTitle' => 'Leave',
    'pageTitle' => 'Add New Leave'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->form('POST', route('leaves.store'))->open() }}

                    @include('leave._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection