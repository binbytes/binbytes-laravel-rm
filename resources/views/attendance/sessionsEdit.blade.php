@extends('layouts.app', [
    'subTitle' => 'Attendance',
    'pageTitle' => 'update Today Log'
])

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->modelForm($attendanceSession, 'PUT', route('attendance.update', $attendanceSession->id))
                         ->open() }}

                    <div class="form-group row">
                        {{ html()->label('Start Time')
                                    ->for('start_time')
                                    ->class('col-sm-3 col-form-label text-md-right')
                         }}

                        <div class="col-md-6">
                            {{ html()->text('start_time')
                                    ->class(['form-control', 'is-invalid' => $errors->has('start_time')])
                                    ->autofocus()
                            }}

                            @if ($errors->has('start_time'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('start_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('End Time')
                                    ->for('end_time')
                                    ->class('col-sm-3 col-form-label text-md-right')
                        }}

                        <div class="col-md-6">
                            {{ html()->text('end_time')
                                    ->class(['form-control', 'is-invalid' => $errors->has('end_time')])
                            }}

                            @if ($errors->has('end_time'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('end_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label('Note')
                                    ->for('note')
                                    ->class('col-sm-3 col-form-label text-md-right')
                        }}

                        <div class="col-md-6">
                            {{ html()->text('note')
                                    ->class(['form-control', 'is-invalid' => $errors->has('note')])
                            }}

                            @if ($errors->has('note'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="/dashboard" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection