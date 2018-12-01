@extends('layouts.app', [
    'pageTitle' => 'Leave'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <div class="row">
                        <input id="filter-type" type="hidden" value="all">
                        <div class="btn-group ml-3">
                            <button class="btn btn-info btn-filter" value="all">All</button>
                            <button class="btn btn-info btn-filter" value="upcoming">Upcoming</button>
                            <button class="btn btn-info btn-filter" value="past">Past</button>
                        </div>
                        <a href="/leaves/create" class="btn btn-primary ml-auto mr-3">
                            <i class="fa fa-plus mr-2"></i>
                            Add Leave
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="leave-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Subject</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Approved Status</th>
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
            let dt = $('#leave-table').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                ajax: {
                    url: '{!! route('leaves.index') !!}',
                    data: function ( d ) {
                        d.filter = $('#filter-type').val()
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'user.username', name: 'user.username'},
                    { data: 'subject', name: 'subject' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'approved', name: 'approved', sortable: false },
                    { data: 'action', name: 'action', sortable: false }
                ]
            })

            $('.btn-filter').click(function(){
                $('#filter-type').attr('value', $(this).val())
                dt.draw()
            })
        })
    </script>
@endpush
