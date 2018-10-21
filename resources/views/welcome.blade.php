@extends('layouts.app', [
    'pageTitle' => 'Home'
])

@section('content')
    <div class="row">
        <div>
            <img src="/images/logo.png" class="card-img-top" alt="{{ config('app.name') }}">
            <div class="card-body text-center">
                <a class="btn btn-lg btn-outline-secondary" href="/login">Login</a>
            </div>
        </div>
    </div>
@endsection