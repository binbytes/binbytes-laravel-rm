@extends('letter.layoutletter')

@section('data')
  <tr>
    <td class="p-3">
      <table class="table table-borderless">
        <tr>
          <td class="logo pt-4">
            <img src="{{ url('images/logo.png') }}" alt="Logo" width="50">
          </td>
          <td>
            <b>BINBYTES</b>
            <p class="address mt-3">409-A, The Spire, 150ft Ring Road, Rajkot-360006, Gujarat, India.</p>
            <p class="address">Phone : (+91) 75670 72070 / (+91) 90330 90059</p>
          </td>
          <td class="text-right w-30 pl-0">
            <b class="header-title">PAID SALARY</b>
            <p class="address mt-3">For the {{ $date }}</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="px-3"><hr></td>
  </tr>
  <tr>
    <td class="p-3">
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
