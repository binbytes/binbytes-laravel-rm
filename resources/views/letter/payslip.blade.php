@extends('letter.layoutletter')

@section('data')
    <tr>
        <th class="p-3">
            <h4 align="center" class="pb-4"><b>Payslip for the month of {{ date('F Y', strtotime($salary->paid_for)) }}</b></h4>
        </th>
    </tr>
    <tr>
        <td class="p-3">
            <table class="table table-bordered mt-4">
                <tr>
                    <td colspan="2">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><b>Employee Code</b></td>
                                            <td>BB{{ $salary->user->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Employee Name</b></td>
                                            <td>{{ $salary->user->name }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><b>Date of Joining</b></td>
                                            <td> {{ date('jS F Y', strtotime($salary->user->joining_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Days Worked</b></td>
                                            <td>27</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
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
                                <td class="text-right">{{ number_format($salary->base_salary) }}</td>
                            </tr>
                            @if($salary->bonus)
                                <tr>
                                    <td>Bonus</td>
                                    <td class="text-right">{{ number_format($salary->bonus) }}</td>
                                </tr>
                            @endif
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
                                <td>TDS Deduction</td>
                                <td class="text-right">{{ $salary->tds }}</td>
                            </tr>
                            <tr>
                                <td>Professional Tax</td>
                                <td class="text-right">{{ $salary->pf }}</td>
                            </tr>
                            @if($salary->penalty)
                                <tr>
                                    <td>Deduction</td>
                                    <td class="text-right">{{ $salary->penalty }}</td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="table table-borderless">
                            <tr>
                                <th>Total Earnings</th>
                                <th class="text-right">{{ number_format($salary->base_salary) }}</th>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-borderless">
                            <tr>
                                <th>Total Deductions</th>
                                <th class="text-right">{{ $salary->tds + $salary->pf + $salary->penalty }}</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <p><b>Net Salary : </b>{{ number_format($salary->paid_amount) }} </p>
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
