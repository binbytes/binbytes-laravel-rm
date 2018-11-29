@extends('layouts.app', [
    'subTitle' => 'Transaction',
    'pageTitle' => 'Add New Transaction'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->form('POST', route('transactions.store'))
                        ->acceptsFiles()
                        ->open() }}

                    @include('transaction._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection