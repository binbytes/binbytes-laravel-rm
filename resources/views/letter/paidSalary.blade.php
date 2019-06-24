@extends('letter.layoutletter')

@section('data')
    <tr>
        <th class="p-3">
            <h3 class="center pb-4">Paid salary for the {{ $date }}</h3>
        </th>
    </tr>
    <tr>
        <td class="py-3">
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
                </tr>
                </thead>
                <tbody>
                @forelse($salaries as $salary)
                    <tr>
                        <td>{{ $salary->user->name }}</td>
                        <td>{{ number_format($salary->base_salary) }}</td>
                        <td>{{ $salary->pf }}</td>
                        <td>{{ $salary->tds }}</td>
                        <td>{{ $salary->penalty }}</td>
                        <td>{{ $salary->bonus }}</td>
                        <td>{{ number_format($salary->paid_amount) }}</td>
                        <td>{{ $salary->payment_method }}</td>
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
        </td>
    </tr>
@endsection
