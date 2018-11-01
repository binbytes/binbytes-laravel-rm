@extends('layouts.app', [
    'subTitle' => 'Designations',
    'pageTitle' => 'Update Designation'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($designation, 'PUT', route('designations.update', $designation))
                         ->acceptsFiles()
                         ->open() }}

                    @include('designation._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection