<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta content="telephone=no" name="format-detection" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  {{--  <link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <style>
    @font-face {
      font-family: 'Roboto';
      src: {{ storage_path('fonts/Roboto-Regular.ttf') }} format('truetype');
      font-weight: normal;
      font-style: normal;
    }

    body {
      margin: 0;
      padding: 0;
      font-size: 14px;
      line-height: 160%;
      mso-line-height-rule: exactly;
      color: #434b4d;
      width: 100%;
      font-weight: 400;
    }

    @media only screen and (max-width: 560px) {
      body {
        font-size: 12px !important;
      }
    }

    b, th {
      color: black !important;
      font-weight: 600 !important;
    }

    body, table, td {
      font-family: 'Roboto', sans-serif;
    }

    table {
      width: 100%;
    }

    td {
      padding: 0.3rem 0.2rem !important;
    }

    th {
      padding: .50rem 0.2rem !important;
    }

    @media print {
      .table-borderless tr, .table-borderless td, .table-borderless th, .table-borderless {
        border-style: hidden !important;
      }
    }
  </style>
</head>
<body>
<div class="main-content">
  <div class="p-1">
    <h5 class="mb-2"><b>{{ $start }} To {{ $end }}</b></h5>
    <table class="table table-bordered text-center">
      <thead>
      <tr>
        <th>Id</th>
        <th>Date</th>
        <th class="w-25">Description</th>
        <th>Reference</th>
        <th>Credit Amount</th>
        <th>Debit Amount</th>
        <th>Closing Balance</th>
        <th>Note</th>
      </tr>
      </thead>
      <tbody>
      @forelse($transactions as $transaction)

        <tr>
          <td>{{ $transaction['id'] }}</td>
          <td>{{ $transaction['date'] }}</td>
          <td>{{ $transaction['description'] }}</td>
          <td>{{ $transaction['reference'] }}</td>
          <td>{{ $transaction['credit_amount'] }}</td>
          <td>{{ $transaction['debit_amount'] }}</td>
          <td>{{ $transaction['closing_balance'] }}</td>
          <td>{{ $transaction['note'] }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="9" align="center">
            No transaction log
          </td>
        </tr>
      @endforelse
      </tbody>
      <tfoot>
      <tr>
        <th colspan="4">Total Amount</th>
        <th>{{ $transactions->sum('credit_amount') }}</th>
        <th>{{ $transactions->sum('debit_amount') }}</th>
        <th>{{ $transactions->sum('closing_balance') }}</th>
        <th></th>
      </tr>
      </tfoot>
    </table>
  </div>
</div>
</body>
</html>
