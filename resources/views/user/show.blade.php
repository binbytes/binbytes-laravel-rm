@extends('layouts.app', [
    'subTitle' => 'Users',
    'pageTitle' => 'View User'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ $user->name }}</h6>
                </div>

                <div class="card-body">
                    @if($user->avatar)
                        <div class="text-center">
                            <img src="{{ $user->avatar_url }}" width="100" class="img-thumbnail">
                        </div>
                    @endif

                    <table class="table table-bordered">
                        @foreach($user->toArray() as $key => $value)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <a href="/users" class="btn btn-link">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection