@extends('layouts.app', [
    'subTitle' => 'Holiday',
    'pageTitle' => 'View Holiday'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ $holiday->title }}</h6>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        @foreach($holiday->toArray() as $key => $value)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <a href="/holidays" class="btn btn-link">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection