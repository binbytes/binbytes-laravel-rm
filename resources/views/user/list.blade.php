@extends('layouts.app', [
    'pageTitle' => 'Users'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                @can('create', App\User::class)
                    <div class="card-header border-bottom">
                        <a href="/users/create" class="btn btn-primary pull-right">
                            <i class="fa fa-plus mr-2"></i>
                            Add User
                        </a>
                    </div>
                @endcan
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile Number</th>
                                @can('show', App\User::class)
                                    <th scope="col">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @if($user->avatar)
                                        <img src="{{ $user->avatar_url }}" class="avatar mr-1">
                                    @endif
                                    {{ $user->name }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile_no }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        @can('show', App\User::class)
                                            <a class="btn btn-white" href="/users/{{ $user->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('delete', App\User::class)
                                            {{ html()->form('DELETE', route('users.destroy', $user->id))->open() }}
                                                <button type="submit" class="btn btn-white">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            {{ html()->form()->close() }}
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection