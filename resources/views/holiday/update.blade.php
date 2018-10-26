@extends('layouts.app', [
    'subTitle' => 'Holidays',
    'pageTitle' => 'Update Holiday'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($holiday, 'PUT', route('holidays.update', $holiday))
                         ->acceptsFiles()
                         ->open() }}

                    {{ html()->hidden('id', $holiday->id) }}

                    @include('holiday._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection