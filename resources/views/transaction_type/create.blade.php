@extends('layouts.app', [
    'subTitle' => 'Transaction Type',
    'pageTitle' => 'Add New Transaction Type'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->form('POST', route('transaction-types.store'))
                        ->open() }}

                    @include('transaction_type._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection