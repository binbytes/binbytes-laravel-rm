@extends('layouts.app', [
    'pageTitle' => 'Users'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            <div class="card card-small mb-4">
                @can('create', App\User::class)
                    <div class="card-header border-bottom text-right">
                        <a href="/users/create" class="btn btn-primary">
                            <i class="fa fa-plus mr-2"></i>
                            Add User
                        </a>
                    </div>
                @endcan
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="users-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Skype</th>
                                <th>Slack</th>
                                <th>Twitter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('users.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'username', name: 'username' },
                    { data: 'email', name: 'email' },
                    { data: 'mobile_no', name: 'mobile_no' },
                    { data: 'skype', name: 'skype' },
                    { data: 'slack', name: 'slack' },
                    { data: 'twitter', name: 'twitter' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            });
        });
    </script>
@endpush