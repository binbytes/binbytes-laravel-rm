@extends('layouts.app', [
    'subTitle' => 'Leave',
    'pageTitle' => 'Update Leave'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($leave, 'PUT', route('leaves.update', $leave))
                         ->acceptsFiles()
                         ->open() }}

                    {{ html()->hidden('id', $leave->id) }}

                    @include('leave._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
