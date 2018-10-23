@extends('layouts.app', [
    'subTitle' => 'Leave',
    'pageTitle' => 'View Leave'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ $leave->user->name }}</h6>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        @foreach($leave->toArray() as $key => $value)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="/leaves" class="btn btn-link">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection