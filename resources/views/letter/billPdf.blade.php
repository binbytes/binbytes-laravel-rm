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
            line-height: 90%;
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
            font-weight: 500 !important;
        }

        body, table, td {
            font-family: 'Roboto', sans-serif;
        }

        table {
            width: 100%;
            margin-bottom: 0 !important;
        }

        .w-20 {
            width: 20%;
        }

        .w-25 {
            width: 30%;
        }

        .w-35 {
            width: 35%;
        }

        .w-65 {
            width: 65%;
        }

        .header {
            border-bottom: 1px solid #8a8a8a !important;
            padding: 10px 5px !important;
            text-align: left !important;
        }

        .table-secondary td, .thead-dark th {
            border: 1px solid #8a8a8a !important;
        }

        tfoot .table-secondary>th {
            border: 1px solid #bbbaba !important;
        }

        hr {
            border-bottom: 1px solid #949393;
            margin-bottom: 0.3rem !important;
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
    <div>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td class="w-35">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td>
                                    <p>BinBytes</p>
                                    <p>409-A, The Spire</p>
                                    <p>150-Ft Ring Road</p>
                                    <p>Rajkot, Gujarat - 360005</p>
                                    <p>info@binbytes.com</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="w-65">
                        <table class="table table-bordered text-center">
                            <tbody>
                            <tr>
                                <td class="w-35 table-dark header">
                                    INVOICE NO.
                                </td>
                                <td class="w-65" style="border-bottom: 1px solid #dee2e6; padding: 10px 0 !important;">
                                    {{ $bill->project['invoice_prefix'] ? $bill->project['invoice_prefix'] : 'BB' }}-{{ $bill['id'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-25 table-dark header">DATE</td>
                                <td class="w-75" style="padding: 10px 0 !important;">{{ date_format($bill['date'], 'd/m/Y') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="w-35">
                        <table class="table table-borderless">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-white">BILL TO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td >
                                    <p>{{ $bill->client['name'] }}</p>
                                    <p>{{ $bill->project['title'] }}</p>
                                    <p>{{ $bill->client['address'] }}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
            <tr>
                <th class="text-white">DESCRIPTION</th>
                <th class="w-25 text-white">AMOUNT (USD)</th>
                <th class="w-25 text-white">AMOUNT (INR)</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $bill->project['description'] ? $bill->project['description'] : 'Project' }}</td>
                    <td class="w-25">${{ number_format($bill['amount'] / 72, 2 )}}</td>
                    <td class="w-25"><span style="font-family: DejaVu Sans;">&#x20B9;</span>
                        {{ number_format($bill['amount'], 2) }}
                    </td>
                </tr>
                @for($a = 0; $a < 6; $a++)
                    <tr>
                        <td><p style="height: 2px !important;"></p></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
                <tr>
                    @php
                        $igst = 0.00
                    @endphp
                    <td class="text-left">Export Against LUT (IGST)</td>
                    <td></td>
                    <td><span style="font-family: DejaVu Sans;">&#x20B9;</span>{{$igst}}</td>
                </tr>
            </tbody>
            <tfoot>
            <tr class="table-secondary">
                <th class="text-right pr-3">Total Amount</th>
                <th class="w-25">${{ number_format($bill['amount'] / 72, 2 )}}</th>
                <th class="w-25"><span style="font-family: DejaVu Sans;">&#x20B9;</span>
                    {{ number_format(($bill['amount'] + $igst), 2) }}
                </th>
            </tr>
            <tr>
                <td colspan="3" class="text-left">Remarks/Instructions:</td>
            </tr>
            </tfoot>
        </table>
        <div class="d-flex mt-5">
            <table class="table table-borderless mt-5 ml-auto w-20 text-center">
                <tr>
                    <td>
                        <hr/>
                        <p>Signature</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
