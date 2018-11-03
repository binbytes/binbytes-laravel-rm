@extends('latter.layoutlatter')

@section('data')
    <tr>
        <th colspan="2" class="text-center p-3">
           Payslip for the month of {{ now()->format('F Y') }}
        </th>
    </tr>
    <tr class="info">
        <td colspan="2">
            <table class="table table-borderless">
                <tr>
                    <td>
                        <table class="table table-borderless">
                            <tr>
                                <td class="lable">Employee Code</td>
                                <td>BB{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <td class="lable">Date of Joining</td>
                                <td> {{ date('jS F Y', strtotime($user->joining_date))}}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-borderless">
                            <tr>
                                <td class="lable">Employee Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td class="lable">Days Worked</td>
                                <td>27</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="info">
        <td>
            <table class="table table-borderless">
                <tr>
                    <th class="title" colspan="2">Earnings</th>
                </tr>
                <tr>
                    <th>Particulars</th>
                    <th class="text-right">Amount</th>
                </tr>
                <tr>
                    <td>Basic Salary</td>
                    <td class="text-right">{{ number_format($user->base_salary) }}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-borderless">
                <tr>
                    <th class="title" colspan="2">Deductions</th>
                </tr>
                <tr>
                    <th>Particulars</th>
                    <th class="text-right">Amount</th>
                </tr>
                <tr>
                    <td>LWF Deduction</td>
                    <td class="text-right">6.00</td>
                </tr>
                <tr>
                    <td>Professional Tax</td>
                    <td class="text-right">200.00</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table class="table table-borderless">
                <tr>
                    <th>Total Earnings</th>
                    <th class="text-right">{{ number_format($user->base_salary) }}</th>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-borderless">
                <tr>
                    <th>Total Deductions</th>
                    <th class="text-right">206.00</th>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="table table-borderless">
                <tr>
                    <td>
                        <h6>Net Salary : {{ number_format($user->base_salary) }} </h6>
                        <?php
                        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                        ?>
                        <h6></h6>
                        <h6>Inwords : {{strtoupper($f->format($user->base_salary))}} ONLY(All Amount Is In <i class="fas fa-rupee-sign"></i>)</h6>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
