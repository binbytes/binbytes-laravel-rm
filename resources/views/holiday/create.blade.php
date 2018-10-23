@extends('layouts.app', [
    'subTitle' => 'Holidays',
    'pageTitle' => 'Add New Holiday'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('holidays.store') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-5">
                                <input id="title" type="text" placeholder="Title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <textarea id="description" placeholder="Description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-daterange input-group input-date-range">
                                <div class="col-md-5">
                                    <input id="start_date" placeholder="Start Date" type="text" class="form-control input-date{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}">
                                    @if ($errors->has('start_date'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <input id="end_date" placeholder="End Date" type="text" class="form-control input-date{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}">
                                    @if ($errors->has('end_date'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-daterange input-group">
                                <div class="col-md-5">
                                    <input id="start_date_partial_hours" placeholder="Start Partial Hours" type="text" class="form-control {{ $errors->has('start_date_partial_hours') ? ' is-invalid' : '' }}" name="start_date_partial_hours" value="{{ old('start_date_partial_hours') }}">
                                    @if ($errors->has('start_date_partial_hours'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('start_date_partial_hours') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <input id="end_date_partial_hours" placeholder="End partial Hours" type="text" class="form-control {{ $errors->has('end_date_partial_hours') ? ' is-invalid' : '' }}" name="end_date_partial_hours" value="{{ old('end_date_partial_hours') }}">
                                    @if ($errors->has('end_date_partial_hours'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('end_date_partial_hours') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>

                                <a class="btn btn-link" href="/holidays">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection