@extends('letter.layoutletter')

@section('data')
  <tr>
    <td class="px-3 pt-3">
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
          <td class="text-right w-25 pl-0">
            <b class="header-title">PAYSLIP</b>
            <p class="address mt-3">For the month of {{ date('F Y', strtotime($salary->paid_for)) }}</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="px-3 py-2">
      <table class="table">
        <tr>
          <td class="px-1 pb-4 pt-2" colspan="2" style="border-top: 1px solid #0a0a0a;">
            <table class="table table-borderless py-2">
              <tr>
                <th>Employee Pay Summary</th>
              </tr>
              <tr>
                <td class="w-20">Employee Code</td>
                <td class="w-50">BB{{ $salary->user->id }}</td>
              </tr>
              <tr>
                <td class="w-20">Employee Name</td>
                <td class="w-50">{{ $salary->user->name }}</td>
              </tr>
              <tr>
                <td class="w-20">Designation</td>
                <td class="w-50"> {{ $salary->user->designation->title }}</td>
              </tr>
              <tr>
                <td class="w-20">Date of Joining</td>
                <td class="w-50"> {{ date('jS F Y', strtotime($salary->user->joining_date))}}</td>
              </tr>
              <tr>
                <td class="w-20">Pay Date</td>
                <td class="w-50">{{ date('jS F Y', strtotime($salary->paid_for))}}</td>
              </tr>
              <tr>
                <td class="w-20">Account Number</td>
                <td class="w-50">{{ $salary->user->account->account_number }}</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="pt-4 pr-1 pb-3">
            <table class="table table-borderless">
              <tr style="background-color: #f2f3f5;">
                <th class="title pl-2">Earnings</th>
                <th class="text-right pr-2">Amount</th>
              </tr>
              <tr>
                <td class="pl-2">Basic Salary</td>
                <td class="text-right pr-2">{{ number_format($salary->base_salary) }}</td>
              </tr>
              @if($salary->bonus)
                <tr>
                  <td class="pl-2">Bonus</td>
                  <td class="text-right pr-2">{{ number_format($salary->bonus) }}</td>
                </tr>
              @endif
            </table>
          </td>
          <td class="pt-4 pl-1 pb-3">
            <table class="table table-borderless">
              <tr style="background-color: #f2f3f5;">
                <th class="title pl-2">Deductions</th>
                <th class="text-right pr-2">Amount</th>
              </tr>
              <tr>
                <td class="pl-2">TDS Deduction</td>
                <td class="text-right pr-2">{{ $salary->tds }}</td>
              </tr>
              <tr>
                <td class="pl-2">Professional Tax</td>
                <td class="text-right pr-2">{{ $salary->pf }}</td>
              </tr>
              @if($salary->penalty)
                <tr>
                  <td class="pl-2">Deduction</td>
                  <td class="text-right pr-2">{{ $salary->penalty }}</td>
                </tr>
              @endif
            </table>
          </td>
        </tr>
        <tr>
          <td class="pb-3 pt-2">
            <table class="table table-borderless">
              <tr>
                <th>Total Earnings</th>
                <th class="text-right pr-2">{{ number_format($salary->base_salary) }}</th>
              </tr>
            </table>
          </td>
          <td class="pb-3 pt-2">
            <table class="table table-borderless">
              <tr>
                <th>Total Deductions</th>
                <th class="text-right pr-2">{{ $salary->tds + $salary->pf + $salary->penalty }}</th>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="py-3" colspan="2">
            <table class="table table-borderless">
              <tr>
                <td class="pt-2">
                  <p class="mb-2"><b>Net Salary : </b>{{ number_format($salary->paid_amount) }} Rs.</p>
                  <?php
                  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                  ?>
                  <p>
                      <b>Inwards : </b>{{strtoupper($f->format($salary->paid_amount))}} ONLY(All Amount Is In INR)
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
@endsection
