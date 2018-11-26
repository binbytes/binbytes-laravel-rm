@extends('letter.layoutletter')

@section('data')
    <tr>
        <th colspan="2" class="heading">
            <h3 class="center py-4"><u>Payslip for the month of {{ date('F Y', strtotime($salary->paid_for)) }}</u></h3>
        </th>
    </tr>
    <tr>
        <table class="table table-bordered mb-5">
            <tr class="info latter">
                <td colspan="2">
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="label">Employee Code</td>
                                        <td>BB{{ $salary->user->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Employee Name</td>
                                        <td>{{ $salary->user->name }}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="label">Date of Joining</td>
                                        <td> {{ date('jS F Y', strtotime($salary->user->joining_date))}}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Days Worked</td>
                                        <td>27</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="info latter">
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
                            <td>Penalty</td>
                            <td class="text-right">{{ $salary->penalty }}</td>
                        </tr>
                        @endif
                    </table>
                </td>
            </tr>
            <tr class="latter">
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
            <tr class="latter">
                <td colspan="2">
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <p>Net Salary : {{ number_format($salary->paid_amount) }} </p>
                                <?php
                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                ?>
                                <p>
                                    Inwords : {{strtoupper($f->format($salary->paid_amount))}} ONLY(All Amount Is In <i class="fas fa-rupee-sign"></i>)
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </tr>
@endsection
