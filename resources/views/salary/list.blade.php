@extends('layouts.app', [
'pageTitle' => 'Users Salary'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
            <form method="POST" action="/salaries">
                @csrf
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <div class="row">
                            <div class="ml-3">
                                <h4 class="mb-0"><span class="badge badge-secondary">{{ today()->format('F-Y') }}</span></h4>
                            </div>
                            <div class="ml-auto mr-3">
                                <div class="d-flex">
                                    {{ html()->select('payment_method')
                                        ->id('payment_method')
                                        ->class('form-control mr-1')
                                        ->options(config('rm.payment_methods'))
                                    }}
                                    <button type="submit" class="btn btn-primary">Mark Paid</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"/></th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Basic salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td><input type="checkbox" class="chk-user" name="users[]" value="{{ $user->id }}"></td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->base_salary }}</td>
                                    <td>
                                        <a href="/salaries/{{$user->id}}/edit" class="btn btn-white">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" align="center">
                                        Salary has been paid for all users.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#select-all").click(function () {
                $('.chk-user').attr('checked', this.checked);
            });
        })
    </script>
@endpush
