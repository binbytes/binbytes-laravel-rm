@extends('layouts.app', [
    'pageTitle' => 'Transaction'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            <div class="card card-small mb-4">
                @can('create', App\Transaction::class)
                    <div class="card-header border-bottom">
                        <div class="row">
                            <a href="/transactions/create" class="btn btn-primary ml-auto mr-3">
                                <i class="fa fa-plus mr-2"></i>
                                Add Transaction
                            </a>
                        </div>
                    </div>
                @endcan
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="transaction-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Account</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Credit Amount</th>
                                <th>Debit Amount</th>
                                <th>Closing Balance</th>
                                <th>Type</th>
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
           let dt = $('#transaction-table').DataTable({
              processing: true,
              serverSide: true,
              order: [ [0, 'desc'] ],
              ajax: '{!! route('transactions.index') !!}',
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'account', name: 'account' },
                  { data: 'date', name: 'date' },
                  { data: 'description', name: 'description' },
                  { data: 'credit_amount', name: 'credit_amount' },
                  { data: 'debit_amount', name: 'debit_amount' },
                  { data: 'closing_balance', name: 'closing_balance' },
                  { data: 'type', name: 'type' },
                  { data: 'action', name: 'action', sortable: false },
              ]
            });

            @include('shared.dtDeleteScript', [
                'dtTable' => 'transaction-table',
                'dtVar' => 'dt'
            ])
        });
    </script>
@endpush