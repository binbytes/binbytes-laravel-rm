@extends('layouts.app', [
    'pageTitle' => 'Accounts'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    @can('create', \App\Account::class)
                        <div class="row">
                            <a href="/accounts/create" class="btn btn-primary ml-auto mr-3">
                                <i class="fa fa-plus mr-2"></i>
                                Add Account
                            </a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="account-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Name</th>
                                <th>Bank Name</th>
                                <th>Account Number</th>
                                <th>Branch</th>
                                <th>IFSC Code</th>
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
            let dt = $('#account-table').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                ajax: '{!! route('accounts.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'user', name: 'user' },
                    { data: 'name', name: 'name' },
                    { data: 'bank_name', name: 'bank_name' },
                    { data: 'account_number', name: 'account_number' },
                    { data: 'branch_of', name: 'branch_of' },
                    { data: 'ifsc_code', name: 'ifsc_code' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            });

            @include('shared.dtDeleteScript', [
                'dtTable' => 'account-table',
                'dtVar' => 'dt'
            ])
        });
    </script>
@endpush