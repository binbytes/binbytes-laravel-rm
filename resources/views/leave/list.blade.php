@extends('layouts.app', [
    'pageTitle' => 'Leave'
])

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <a href="/leaves/create" class="btn btn-primary pull-right">
                        <i class="fa fa-plus mr-2"></i>
                        Add Leave
                    </a>
                </div>
                <div class="card-body p-0 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Description</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaves as $leave)
                            <tr>
                                <td>
                                    @if($leave->user->avatar)
                                        <img src="{{ $leave->user->avatar_url }}" class="avatar mr-1">
                                    @endif
                                    {{ $leave->user->name }}
                                </td>
                                <td>{{ $leave->subject }}</td>
                                <td>{{ $leave->description }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>
                                    <a href="/leaves/{{ $leave->id }}">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $leaves->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection