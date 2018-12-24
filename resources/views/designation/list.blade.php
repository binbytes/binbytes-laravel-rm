@extends('layouts.app', [
    'pageTitle' => 'Designation'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                <div class="card-header border-bottom text-right">
                    <a href="/designations/create" class="btn btn-primary">
                        <i class="fa fa-plus mr-2"></i>
                        Add Designation
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered p-0 text-center" id="designation-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
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
            let dt = $('#designation-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('designations.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            });

            @include('shared.dtDeleteScript', [
                'dtTable' => 'designation-table',
                'dtVar' => 'dt'
            ])
        });
    </script>
@endpush