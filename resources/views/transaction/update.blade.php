@extends('layouts.app', [
    'subTitle' => 'Transaction',
    'pageTitle' => 'Update Transaction'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($transaction, 'PUT', route('transactions.update', $transaction))
                         ->acceptsFiles()
                         ->open() }}

                    {{ html()->hidden('id', $transaction->id) }}

                    @include('transaction._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection