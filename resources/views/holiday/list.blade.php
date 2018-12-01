@extends('layouts.app', [
    'pageTitle' => 'Holiday'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            <div class="card card-small mb-4">
                @can('create', App\Holiday::class)
                    <div class="card-header border-bottom">
                        <div class="row">
                            <input id="filter-type" type="hidden" value="all">
                            <div class="btn-group ml-3">
                                <button class="btn btn-info btn-filter" value="all">All</button>
                                <button class="btn btn-info btn-filter" value="upcoming">Upcoming</button>
                                <button class="btn btn-info btn-filter" value="past">Past</button>
                            </div>
                            <a href="/holidays/create" class="btn btn-primary ml-auto mr-3">
                                <i class="fa fa-plus mr-2"></i>
                                Add Holiday
                            </a>
                        </div>
                    </div>
                @endcan
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="holiday-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
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
            let dt = $('#holiday-table').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                ajax: {
                    url: '{!! route('holidays.index') !!}',
                    data: function ( d ) {
                        d.filter = $('#filter-type').val()
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            })

            $('.btn-filter').click(function(){
                $('#filter-type').attr('value', $(this).val())
                dt.draw()
            })
        })
    </script>
@endpush
