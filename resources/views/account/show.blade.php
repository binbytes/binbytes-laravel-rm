@extends('layouts.app', [
    'pageTitle' => 'User Account'
])

@section('content')

    @include('account._account-view')

    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <div class="row">
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
                                    ->options(['all' => 'All', 'credit_amount' => 'Credit', 'debit_amount' => 'Debit', 'closing_balance' => 'Closing Balance'])
                                    ->value('all')
                            }}
                            {{ html()->select('operator')
                                    ->id('operator')
                                    ->class('form-control mr-2')
                                    ->options(['>' => '>', '<' => '<', '=' => '=',  '<=' => '<=', '>=' => '>='])
                                    ->value('')
                            }}
                            {{ html()->text('amount')
                                    ->id('amount')
                                    ->placeholder('Amount')
                                    ->class('form-control mr-2')
                                    ->value('')
                            }}

                            {{ html()->select('invoice')
                                    ->id('invoice')
                                    ->class('form-control mr-1')
                                    ->options(['all' => 'All', 'with_invoice' => 'With Invoice', 'without_invoice' => 'Without Invoice'])
                                    ->value('all')
                            }}
                            <button id="btn-filter" class="btn btn-primary">Go</button>
                        </div>
                    </div>
                    @can('importTransactions', $account)
                        <div class="row pt-3">
                            <div class="form-inline ml-auto mr-3">
                                {{ html()->form('POST', route('transaction-import', $account->id))
                                        ->acceptsFiles()
                                        ->open() }}

                                {{ html()->file('file')
                                        ->id('file')
                                        ->class('form-control')
                                        ->required()
                                }}

                                {{ html()->button('Import Transaction')
                                         ->id('import')
                                        ->class('btn btn-primary disabled')

                                }}
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    @endcan
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
                order: [ [0, 'desc'] ],
                'ajax': {
                    'url': '{!! route('accounts.show', $account) !!}',
                    'data': function ( d ) {
                        d.month = $('#month').val()
                        d.date = $('#filter-date').val()
                        d.filter_type = $('#filter_type').val()
                        d.operator = $('#operator').val()
                        d.amount_value = $('#amount').val()
                        d.invoice =$('#invoice').val()
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

            $('#file').change(function () {
                if($('#file').val()) {
                    $('#import').removeClass('disabled');
                } else {
                    $('#import').addClass('disabled');
                }
            })

            $('#btn-filter').click(function(){
                let month = $('#month').val()
                let year = $('#year').val()
                let date = month + '-' + year

                $('#month').attr('option', 'value', month)
                $('#year').attr('value', year)

                $('#filter-date').attr('value', date)

                $('#filter_type').attr('option', 'value', $('#filter_type').val())

                $('#invoice').attr('option', 'value', $('#invoice').val())
                dt.draw()
            })
        });
    </script>
@endpush