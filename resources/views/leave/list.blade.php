@extends('layouts.app', [
    'pageTitle' => 'Leave'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <a href="/leaves/create" class="btn btn-primary pull-right">
                        <i class="fa fa-plus mr-2"></i>
                        Add Leave
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered text-center" id="leave-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Subject</th>
                            <th>Description</th>
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
            $('#leave-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('leaves.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'user.username', name: 'user.username'},
                    { data: 'subject', name: 'subject' },
                    { data: 'description', name: 'description' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'approved', name: 'approved', sortable: false },
                    { data: 'action', name: 'action', sortable: false }
                ]
            });
        });
    </script>
@endpush
