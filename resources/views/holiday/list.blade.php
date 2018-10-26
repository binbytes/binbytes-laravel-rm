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
                        <a href="/holidays/create" class="btn btn-primary pull-right">
                            <i class="fa fa-plus mr-2"></i>
                            Add Holiday
                        </a>
                    </div>
                @endcan
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="holiday-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
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
            $('#holiday-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('holidays.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'description', name: 'description' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            });
        });
    </script>
@endpush
