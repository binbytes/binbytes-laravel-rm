@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ $user->name }}</div>

                    <div class="card-body">
                        @if($user->avatar)
                            <div class="text-center">
                                <img src="{{ \Storage::url($user->avatar) }}" height="200" width="200">
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
    </div>
@endsection