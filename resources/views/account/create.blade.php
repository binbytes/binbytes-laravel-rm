@extends('layouts.app', [
    'subTitle' => 'Account',
    'pageTitle' => 'Add New Account'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->form('POST', route('accounts.store'))->open() }}

                    @include('account._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection