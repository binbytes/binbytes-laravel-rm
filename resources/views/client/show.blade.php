@extends('layouts.app', [
    'subTitle' => 'Clients',
    'pageTitle' => 'View Client'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ $client->name }}</h6>
                </div>

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
@endsection