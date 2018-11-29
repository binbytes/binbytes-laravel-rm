@extends('layouts.app', [
    'subTitle' => 'Account',
    'pageTitle' => 'Update Account'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($account, 'PUT', route('accounts.update', $account))
                         ->acceptsFiles()
                         ->open() }}

                    {{ html()->hidden('id', $account->id) }}

                    @include('account._form')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection