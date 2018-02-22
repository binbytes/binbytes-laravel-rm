@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ $client->name }}</div>

                    <div class="card-body">
                        @if($client->avatar)
                            <div class="text-center">
                                <img src="{{ \Storage::url($client->avatar) }}" height="200" width="200">
                            </div>
                        @endif

                        <table class="table table-bordered">
                            @foreach($client->toArray() as $key => $value)
                                <tr>
                                    <th>{{ $key }}</th>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <a href="/clients" class="btn btn-link">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection