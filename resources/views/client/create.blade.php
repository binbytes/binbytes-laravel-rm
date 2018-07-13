@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Client</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('clients.store') }}">
                            @csrf

                            <h5 class="text-black-50">Personal Detail</h5>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input id="name" type="text" placeholder="Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="company_name" type="text" placeholder="Company Name" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}">

                                    @if ($errors->has('company_name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="dob" placeholder="Date of birth" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}">

                                    @if ($errors->has('dob'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="address" placeholder="Address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address">{{ old('address') }}</textarea>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input id="country" type="text" placeholder="Country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country') }}">

                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="city" type="text" placeholder="City" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}">

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="timezone" type="text" placeholder="Timezone" class="form-control{{ $errors->has('timezone') ? ' is-invalid' : '' }}" name="timezone" value="{{ old('timezone') }}">

                                    @if ($errors->has('timezone'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('timezone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <h5 class="text-black-50">Account Detail</h5>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input id="mobile_no" type="text" placeholder="Mobile Number" class="form-control{{ $errors->has('mobile_no') ? ' is-invalid' : '' }}" name="mobile_no" value="{{ old('mobile_no') }}">

                                    @if ($errors->has('mobile_no'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="email" placeholder="Email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <h5 class="text-black-50">Social Detail</h5>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input id="skype" placeholder="Skype" type="text" class="form-control{{ $errors->has('skype') ? ' is-invalid' : '' }}" name="skype" value="{{ old('skype') }}">

                                    @if ($errors->has('skype'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="trello" placeholder="Trello" type="text" class="form-control{{ $errors->has('trello') ? ' is-invalid' : '' }}" name="trello" value="{{ old('trello') }}">

                                    @if ($errors->has('trello'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('trello') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="slack" placeholder="Slack" type="text" class="form-control{{ $errors->has('slack') ? ' is-invalid' : '' }}" name="slack" value="{{ old('slack') }}">

                                    @if ($errors->has('slack'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('slack') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input id="github" placeholder="Github" type="text" class="form-control{{ $errors->has('github') ? ' is-invalid' : '' }}" name="github" value="{{ old('github') }}">

                                    @if ($errors->has('github'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('github') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="twitter" placeholder="Twitter" type="text" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" name="twitter" value="{{ old('twitter') }}">

                                    @if ($errors->has('twitter'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="linkedin" placeholder="Linkedin" type="text" class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" name="linkedin" value="{{ old('linkedin') }}">

                                    @if ($errors->has('slack'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea name="remarks" placeholder="Remarks" id="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}">{{ old('remarks') }}</textarea>

                                    @if ($errors->has('remarks'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>

                                    <a class="btn btn-link" href="/clients">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection