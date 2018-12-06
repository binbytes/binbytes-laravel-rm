@extends('layouts.app', [
    'pageTitle' => 'Transaction Type'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <div class="row">
                            <a href="/transaction-types/create" class="btn btn-primary ml-auto mr-3">
                                <i class="fa fa-plus mr-2"></i>
                                Add Transaction Type
                            </a>
                        </div>
                    </div>
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="transactionType-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Transaction Type</th>
                                <th>Parent Id</th>
                                <th>Model Name</th>
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
            $('#transactionType-table').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                ajax: '{!! route('transaction-types.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'transaction_type', name: 'transaction_type' },
                    { data: 'parent_id', name: 'parent_id' },
                    { data: 'model_name', name: 'model_name' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            });
        });
    </script>
@endpush