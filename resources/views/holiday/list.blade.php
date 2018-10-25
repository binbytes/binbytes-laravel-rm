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
                <div class="card-body p-0 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($holidays as $holiday)
                            <tr>
                                <td>{{ $holiday->title }}</td>
                                <td>{{ $holiday->description }}</td>
                                <td>{{ $holiday->start_date }}</td>
                                <td>{{ $holiday->end_date }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <a class="btn btn-white" href="/holidays/{{ $holiday->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @can('delete', App\Holiday::class)
                                            {{ html()->form('DELETE', route('holidays.destroy', $holiday->id))->open() }}
                                                <button type="submit" class="btn btn-white">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            {{ html()->form()->close() }}
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $holidays->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection