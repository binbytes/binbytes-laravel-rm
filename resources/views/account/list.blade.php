@extends('layouts.app', [
    'pageTitle' => 'Accounts'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <div class="row">
                        <a href="/accounts/create" class="btn btn-primary ml-auto mr-3">
                            <i class="fa fa-plus mr-2"></i>
                            Add Account
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered p-0 text-center" id="account-table">
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
            $('#account-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('accounts.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'user.username', name: 'user.username' },
                    { data: 'name', name: 'name' },
                    { data: 'bank_name', name: 'bank_name' },
                    { data: 'account_number', name: 'account_number' },
                    { data: 'branch_of', name: 'branch_of' },
                    { data: 'ifsc_code', name: 'ifsc_code' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            });
        });
    </script>
@endpush