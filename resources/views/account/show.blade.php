@extends('layouts.app', [
    'pageTitle' => 'User Account'
])

@section('content')

    @include('account._account-view')

    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <div class="d-flex">
                        {{ html()->form('POST', route('transaction-export'))
                                    ->acceptsFiles()
                                    ->open() }}
                            <div class="form-inline">
                                <input name="account_id" type="hidden" value="{{ $account->id }}">
                                <date-time-picker id="date-time" class="mr-1"></date-time-picker>

                                {{ html()->select('filter_type')
                                        ->id('filter_type')
                                        ->class('form-control mr-1')
                                        ->options(['all' => 'All', 'credit_amount' => 'Credit', 'debit_amount' => 'Debit', 'closing_balance' => 'Closing Balance'])
                                        ->value('all')
                                }}
                                {{ html()->select('operator')
                                        ->id('operator')
                                        ->class('form-control mr-sm-1')
                                        ->options(['=' => '=', '>=' => '>=', '>' => '>', '<=' => '<=', '<' => '<'])
                                        ->value('')
                                }}
                                {{ html()->text('amount')
                                        ->id('amount')
                                        ->placeholder('Amount')
                                        ->class('form-control col-1 mr-1')
                                        ->value('')
                                }}

                                {{ html()->select('invoice')
                                        ->id('invoice')
                                        ->class('form-control mr-1')
                                        ->options(['all' => 'All', 'with_invoice' => 'With Invoice', 'without_invoice' => 'Without Invoice'])
                                        ->value('all')
                                }}

                                {{ html()->select('user')
                                        ->id('user')
                                        ->class('form-control mr-1')
                                        ->placeholder('Select User')
                                        ->options($users)
                                        ->value('')
                                }}

                                @can('view', \App\Client::class)
                                    {{ html()->select('client')
                                            ->id('client')
                                            ->class('form-control mr-1')
                                            ->placeholder('Select Client')
                                            ->options($clients)
                                            ->value('')
                                    }}
                                @endcan

                                {{ html()->select('project')
                                        ->id('project')
                                        ->class('form-control mr-sm-1')
                                        ->placeholder('Select Project')
                                        ->options($projects)
                                        ->value('')
                                }}

                                <input id="model-type" type="hidden" value="">
                                <input id="model-id" type="hidden" value="">

                                <button id="btn-filter" class="btn btn-primary px-3">Go</button>

                                <input id="btn-type" name="btn" type="hidden" value="">
                                {{ html()->button('Export')
                                         ->id('export')
                                        ->class('btn btn-primary px-3 ml-1')
                                }}
                                {{ html()->button('PDF')
                                         ->id('pdf')
                                        ->class('btn btn-primary px-3 ml-1')
                                }}
                            </div>
                        {{ html()->form()->close() }}
                    </div>

                    <div class="d-flex justify-content-between pt-3">
                        @can('importTransactions', $account)
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
                        @endcan

                        @can('deleteAll', $account)
                            <button class="btn btn-primary delete-all">Delete All</button>
                        @endcan
                    </div>

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
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Amount</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <transaction-show></transaction-show>
        <transaction-edit :users="{{ $users }}" :clients="{{ $clients }}" :projects="{{ $projects }}"></transaction-edit>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            console.log($('#start-date').val(), $('#end-date').val(), 'aa')
            let dt = $('#transaction-table').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [[10, 25, 50, 100, 150], [10, 25, 50, 100, 150]],
                pageLength: 150,
                order: [ [1, 'desc'] ],
                'ajax': {
                    'url': '{!! route('accounts.show', $account) !!}',
                    'data': function ( d ) {
                        d.start_date = $('#start-date').val()
                        d.end_date = $('#end-date').val()
                        d.filter_type = $('#filter_type').val()
                        d.operator = $('#operator').val()
                        d.amount_value = $('#amount').val()
                        d.invoice =$('#invoice').val()
                        d.model_type = $('#model-type').val()
                        d.model_id = $('#model-id').val()
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
                ],
                "footerCallback": function(row, data, start, end, display) {
                    let api = this.api();
                    let credit = api
                            .column(4, { page: 'current'})
                            .data()
                            .reduce( function (a, b) {
                                let s = b.indexOf('>') + 1
                                let l = b.indexOf('</') - s
                                let v = b.substr(s, l);
                                return parseFloat(a) + parseFloat(v);
                            }, 0 );

                    let debit = api
                            .column(5, { page: 'current'})
                            .data()
                            .reduce( function (a, b) {
                                let s = b.indexOf('>') + 1
                                let l = b.indexOf('</') - s
                                let v = b.substr(s, l);
                                return parseFloat(a) + parseFloat(v);
                            }, 0 );

                    $( api.column(4).footer() ).html(parseFloat(credit).toFixed(2));
                    $( api.column(5).footer() ).html(parseFloat(debit).toFixed(2));
                }
            });

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

            $('#user').change(function () {
                $('#model-type').attr('value', '\\App\\User')
                $('#model-id').attr('value', $('#user').val())
            })

            $('#client').change(function () {
                $('#model-type').attr('value', '\\App\\Client')
                $('#model-id').attr('value', $('#client').val())
            })

            $('#project').change(function () {
                $('#model-type').attr('value', '\\App\\Project')
                $('#model-id').attr('value', $('#project').val())
            })

            $('#btn-filter').click(function(e){
                e.preventDefault();
                console.log($('#start-date').val(), $('#end-date').val())
                dt.draw()
            });

            $('#transaction-table').on('click', '.select-all', function () {
                $('.chk-transaction').attr('checked', this.checked);
            })

            $('#export').click(function () {
                $('#btn-type').attr('value', 'export')
            })

            $('#pdf').click(function () {
                $('#btn-type').attr('value', 'pdf')
            })

            $('.delete-all').click(function () {
                let ids = []
                $.each($(".chk-transaction:checked"), function() {
                    ids.push($(this).val());
                })

                axios.delete('/delete-selected-transaction', { data: { ids: ids } }).then(() => {
                    dt.draw()
                })
            })

            $(document).on('click', '#edit-data', function() {
                setTimeout(() => {
                    dt.draw()
                }, 500)
            })

            @include('shared.dtDeleteScript', [
                'dtTable' => 'transaction-table',
                'dtVar' => 'dt'
            ])
        });
    </script>
@endpush