@extends('layouts.app', [
    'pageTitle' => 'User Account'
])

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-0">
                <div class="card-header border-bottom text-center">
                    @include('shared.userAvatar', [
                        'user' => $account->user
                    ])
                </div>

                <div class="border-top border-bottom px-4 py-3">
                    <div class="row">
                        <div class="col-lg-7">
                            <h6 class="mb-0">Email <i class="fas fa-envelope-open"></i></h6>
                            <span class="text-muted">{{ $account->user->email }}</span>
                        </div>
                        <div class="col-lg-5">
                            <h6 class="mb-0">Phone <i class="fas fa-phone"></i></h6>
                            <span class="text-muted">{{ $account->contact_number }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h5 class="mb-0">Bank Detail</h5>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h6>Bank Name</h6>
                                </div>
                                <div class="col-lg-7">
                                    <span class="text-muted">{{ $account->bank_name }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <h6>Account Number</h6>
                                </div>
                                <div class="col-lg-7">
                                    <span class="text-muted">{{ $account->account_number }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>Branch</h6>
                                </div>
                                <div class="col-lg-6">
                                    <span class="text-muted">{{ $account->branch_of }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>IFSC Code</h6>
                                </div>
                                <div class="col-lg-6">
                                    <span class="text-muted">{{ $account->ifsc_code }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="/accounts" class="btn btn-link ml-auto mr-3">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <div class="row">
                        <div>
                            <div class="form-inline ml-3">
                                {{ html()->select('month')
                                        ->id('month')
                                        ->placeholder('Select Month')
                                        ->class('form-control mr-1')
                                        ->options(months())
                                        ->value()
                                }}

                                {{ html()->text('year')
                                        ->id('year')
                                        ->class('form-control mr-2')
                                        ->value(today()->format('Y'))
                                }}
                                <input id="filter-date" type="hidden" value="{{ today()->format('m-Y') }}">

                                {{ html()->select('filter_type')
                                        ->id('filter_type')
                                        ->class('form-control mr-1')
                                        ->options(['all' => 'All', 'credit' => 'Credit', 'debit' => 'Debit'])
                                        ->value('all')
                                }}

                                <button id="btn-filter" class="btn btn-primary">Go</button>
                            </div>
                        </div>
                        <div class="form-inline ml-auto mr-3">
                            {{ html()->form('POST', route('transaction-import', $account->id))
                                    ->acceptsFiles()
                                    ->open() }}

                            {{ html()->file('file')
                                    ->class('form-control')
                             }}

                            {{ html()->button('Import Transaction')
                                    ->class('btn btn-primary')
                             }}

                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="transaction-table">
                        <thead>
                            <tr>
                                <th>Id</th>
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
                'ajax': {
                    'url': '{!! route('accounts.show', $account) !!}',
                    'data': function ( d ) {
                        d.month = $('#month').val()
                        d.date = $('#filter-date').val()
                        d.filter_type = $('#filter_type').val()
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'description', name: 'description' },
                    { data: 'credit_amount', name: 'credit_amount' },
                    { data: 'debit_amount', name: 'debit_amount' },
                    { data: 'closing_balance', name: 'closing_balance' },
                    { data: 'type', name: 'type' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            })

            $('#btn-filter').click(function(){
                let month = $('#month').val()
                let year = $('#year').val()
                let date = month + '-' + year

                $('#filter_type').attr('option', 'value', $('#filter_type').val())

                $('#month').attr('option', 'value', month)
                $('#year').attr('value', year)

                $('#filter-date').attr('value', date)
                dt.draw()
            })
        });
    </script>
@endpush