
@extends('layouts.app', [
    'pageTitle' => 'Paid Salary'
])

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-5">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="mb-0">Leaves</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>subject</th>
                            <th>date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($leaves as $leave)
                            <tr>
                                <td>{{ $leave->subject }}</td>
                                <td>{{ $leave->start_date->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" align="center">
                                    No Leaves log available this user.
                                </td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="2" align="right">
                                <span class="text-light">Total Leaves:</span>
                                <strong class="mr-3">{{ count($leaves) }}</strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-7">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($user, 'PUT', route('salaries.update', $user->id))
                         ->acceptsFiles()
                         ->open() }}

                    {{ html()->hidden('id', $user->id) }}

                    <div class="form-group row">
                        {{ html()->label('Name')
                                    ->for('name')
                                    ->class('col-sm-3 col-form-label text-md-right')
                         }}

                        <div class="col-md-6">
                            {{ html()->text('name')
                                    ->class(['form-control', 'is-invalid' => $errors->has('name')])
                                    ->readonly()
                            }}

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Base Salary')
                                    ->for('base_salary')
                                    ->class('col-sm-3 col-form-label text-md-right')
                         }}
                        <div class="col-md-6">
                            {{ html()->text('base_salary')
                                    ->class(['form-control', 'is-invalid' => $errors->has('base_salary')])
                                    ->readonly()
                            }}

                            @if ($errors->has('base_salary'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('base_salary') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Bonus')
                                    ->for('bonus')
                                    ->class('col-sm-3 col-form-label text-md-right')
                         }}
                        <div class="col-md-6">
                            {{ html()->text('bonus')
                                    ->type('number')
                                    ->class(['form-control', 'is-invalid' => $errors->has('bonus')])
                                    ->value('0')
                                    ->autofocus()
                            }}

                            @if ($errors->has('bonus'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('bonus') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Deductions Amount')
                                    ->for('penalty')
                                    ->class('col-sm-3 col-form-label text-md-right')
                         }}
                        <div class="col-md-6">
                            {{ html()->text('penalty')
                                    ->type('number')
                                    ->class(['form-control', 'is-invalid' => $errors->has('penalty')])
                                    ->value('0')
                            }}

                            @if ($errors->has('penalty'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('penalty') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Payment Method')
                                    ->for('payment_method')
                                    ->class('col-sm-3 col-form-label text-md-right')
                         }}

                        <div class="col-md-6">
                            {{ html()->select('payment_method')
                                        ->id('payment_method')
                                        ->class('form-control')
                                        ->options(config('rm.payment_method'))
                            }}

                            @if ($errors->has('payment_method'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('payment_method') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Paid Note')
                                    ->for('paid_note')
                                    ->class('col-sm-3 col-form-label text-md-right')
                         }}
                        <div class="col-md-6">
                            {{ html()->textarea('paid_note')
                                    ->class(['form-control', 'is-invalid' => $errors->has('paid_note')])
                             }}

                            @if ($errors->has('paid_note'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('paid_note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('General Note')
                                    ->for('general_note')
                                    ->class('col-sm-3 col-form-label text-md-right')
                         }}
                        <div class="col-md-6">
                            {{ html()->textarea('general_note')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_note')])
                             }}

                            @if ($errors->has('general_note'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('general_note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-5">
                            {{ html()->button('Save')
                                    ->type('submit')
                                    ->class('btn btn-primary')
                             }}

                            {{ html()->a()
                                   ->href('/salary')
                                   ->text('Cancel')
                                   ->class('btn btn-link')
                             }}
                        </div>
                    </div>

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
