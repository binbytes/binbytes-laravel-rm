@extends('layouts.app', [
    'pageTitle' => 'User Account'
])

@section('content')

    @include('account._account-view')

    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <div class="d-flex justify-content-between">
                        {{ html()->form('POST', route('transaction-export'))
                                    ->acceptsFiles()
                                    ->open() }}
                            <div class="form-inline">
                                <input name="account_id" type="hidden" value="{{ $account->id }}">
                                {{ html()->select('month')
                                        ->id('month')
                                        ->placeholder('Select Month')
                                        ->class('form-control mr-1')
                                        ->options(months())
                                        ->value()
                                }}

                                {{ html()->text('year')
                                        ->id('year')
                                        ->placeholder('Year')
                                        ->class('form-control mr-2')
                                }}
                                <input id="filter-year" type="hidden" value="">
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

                                {{ html()->button('Export Transaction')
                                         ->id('export')
                                        ->class('btn btn-primary ml-5')
                                }}
                            </div>
                        {{ html()->form()->close() }}
                    </div>
                    @can('importTransactions', $account)
                        <div class="d-flex justify-content-between pt-3">
                            <div class="form-inline">
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
                            <button class="btn btn-primary delete-all">Delete All</button>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="transaction-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="select-all"/></th>
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

        <transaction-show></transaction-show>
        <transaction-edit></transaction-edit>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            let dt = $('#transaction-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                order: [ [1, 'desc'] ],
                'ajax': {
                    'url': '{!! route('accounts.show', $account) !!}',
                    'data': function ( d ) {
                        d.month = $('#month').val()
                        d.year = $('#filter-year').val()
                        d.date = $('#filter-date').val()
                        d.filter_type = $('#filter_type').val()
                        d.operator = $('#operator').val()
                        d.amount_value = $('#amount').val()
                        d.invoice =$('#invoice').val()
                    }
                },
                columns: [
                    { data: 'select', name: 'select', sortable: false},
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

            $('#transaction-table').on('click', '.btn-show', function (e) {
                e.preventDefault()
                $('#transaction-show-id').val($(this).attr('rel'));
                $('#transaction-show-id')[0].dispatchEvent(new Event('input', { 'bubbles': true }))
            })

            $('#transaction-table').on('click', '.btn-edit', function (e) {
                e.preventDefault()
                $('#transaction-edit-id').val($(this).attr('rel'));
                $('#transaction-edit-id')[0].dispatchEvent(new Event('input', { 'bubbles': true }))
            })

            $('#file').change(function () {
                if($('#file').val()) {
                    $('#import').removeClass('disabled');
                } else {
                    $('#import').addClass('disabled');
                }
            })

            $('#btn-filter').click(function(e){
                e.preventDefault();
                let month = $('#month').val()
                let year = $('#year').val()

                $('#filter-date').attr('value', month + '-' + year)
                $('#filter-year').attr('value', year)

                dt.draw()
            });

            $('#transaction-table').on('click', '.select-all', function () {
                $('.chk-transaction').attr('checked', this.checked);
            });

            $('.delete-all').click(function () {
                let ids = []
                $.each($(".chk-transaction:checked"), function(){
                    ids.push($(this).val());
                });

                axios.delete('/delete-selected-transaction', { data: { ids: ids } }).then(() => {
                    dt.draw()
                })
            })

            @include('shared.dtDeleteScript', [
                'dtTable' => 'transaction-table',
                'dtVar' => 'dt'
            ])
        });
    </script>
@endpush