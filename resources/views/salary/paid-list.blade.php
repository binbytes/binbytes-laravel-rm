@extends('layouts.app', [
'pageTitle' => 'Paid Salary'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <div class="row">
                            <div class="form-inline ml-3">
                                {{ html()->select('month')
                                        ->id('month')
                                        ->class('form-control mr-1')
                                        ->options(months())
                                        ->value(old('month', isset($month) ? $month : []))
                                }}
                                {{ html()->text('year')
                                        ->id('year')
                                        ->class('form-control mr-2')
                                        ->value(old('month', isset($year) ? $year : []))
                                }}
                                <a id="btn-filter" href="" class="btn btn-primary">Go</a>
                            </div>
                            <div class="ml-auto mr-3">
                                <h4 class="mb-0"><span class="badge badge-secondary">{{ $date }}</span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Basic salary</th>
                                    <th>PF</th>
                                    <th>TDS</th>
                                    <th>Deduction</th>
                                    <th>Bonus</th>
                                    <th>Paid Amount</th>
                                    <th>Payment Method</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($salaries as $salary)
                                <tr>
                                    <td>{{ $salary->user->name }}</td>
                                    <td>{{ $salary->base_salary }}</td>
                                    <td>{{ $salary->pf }}</td>
                                    <td>{{ $salary->tds }}</td>
                                    <td>{{ $salary->penalty }}</td>
                                    <td>{{ $salary->bonus }}</td>
                                    <td>{{ $salary->paid_amount }}</td>
                                    <td>{{ $salary->payment_method }}</td>
                                    <td>
                                        <a href="/salaries/{{ $salary->user->id }}" class="btn btn-white">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" align="center">
                                        No salary log
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
            $('#btn-filter').click(function(){
                let month = $('#month').val()
                let year = $('#year').val()

                $('#btn-filter').attr('href', "/salaries/filter/" + month + "/" + year)
            })
        })
    </script>
@endpush