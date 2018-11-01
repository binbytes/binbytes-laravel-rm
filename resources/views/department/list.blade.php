@extends('layouts.app', [
    'pageTitle' => 'Department'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
            {{--@can('create', App\Department::class)--}}
                    <a href="/departments/create" class="btn btn-primary pull-right">
                        <i class="fa fa-plus mr-2"></i>
                        Add Department
                    </a>
                </div>
            {{--@endcan--}}
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="department-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
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
            $('#department-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('departments.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'remarks', name: 'remarks' },
                    { data: 'action', name: 'action', sortable: false },
                ]
            });
        });
    </script>
@endpush