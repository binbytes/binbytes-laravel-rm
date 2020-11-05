@extends('layouts.app', [
    'pageTitle' => 'Invoice'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex w-75">
                            <date-time-picker id="date-time" class="mr-3 w-100"></date-time-picker>

                            {{ html()->select('client')
                                    ->id('client')
                                    ->class('form-control mr-3 h-auto')
                                    ->placeholder('Select Client')
                                    ->options($clients)
                                    ->value('')
                            }}

                            {{ html()->select('project')
                                    ->id('project')
                                    ->class('form-control mr-3 h-auto')
                                    ->placeholder('Select Project')
                                    ->options($projects)
                                    ->value('')
                            }}

                            <input id="client-id" type="hidden" value="">
                            <input id="project-id" type="hidden" value="">

                            <button id="btn-filter" class="btn btn-primary px-4">Go</button>
                        </div>
{{--                        @can('deleteAll', $account)--}}
                            <button class="btn btn-primary download-all">Download All</button>
{{--                        @endcan--}}
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="invoice-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Project</th>
                                <th>Amount</th>
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
           let dt = $('#invoice-table').DataTable({
              processing: true,
              serverSide: true,
              lengthMenu: [[ 25, 50, 100, 150], [25, 50, 100, 150]],
              pageLength: 100,
              order: [ [0, 'desc'] ],
              'ajax': {
               'url': '{!! route('invoice.index') !!}',
               'data': function ( d ) {
                   d.start_date = $('#start-date').val()
                   d.end_date = $('#end-date').val()
                   d.client_id = $('#client-id').val()
                   d.project_id = $('#project-id').val()
               }
              },
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'date', name: 'date' },
                  { data: 'client', name: 'client' },
                  { data: 'project', name: 'project' },
                  { data: 'amount', name: 'amount' },
                  { data: 'action', name: 'action', sortable: false },
              ]
            });

            $('#client').change(function () {
                $('#client-id').attr('value', $('#client').val())
            })

            $('#project').change(function () {
                $('#project-id').attr('value', $('#project').val())
            })

            $('#btn-filter').click(function(){
                dt.draw()
            });

            $('#transaction-table').on('click', '.select-all', function () {
                $('.chk-transaction').attr('checked', this.checked);
            })

            $('.download-all').click(function () {
                let start_date = $('#start-date').val()
                let end_date = $('#end-date').val()
                let client_id = $('#client-id').val()
                let project_id = $('#project-id').val()

                let url = "start_date=" + start_date + "&end_date=" + end_date + "&client_id=" + client_id + "&project_id=" + project_id

                window.location.href = '/download-all/invoice?' + url
                dt.draw()
            })
        });
    </script>
@endpush