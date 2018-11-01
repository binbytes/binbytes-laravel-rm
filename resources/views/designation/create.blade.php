@extends('layouts.app', [
    'subTitle' => 'Designations',
    'pageTitle' => 'Add New Designation'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->form('POST', route('designations.store'))
                        ->acceptsFiles()
                        ->open() }}

                    @include('designation._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection