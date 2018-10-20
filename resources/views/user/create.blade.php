@extends('layouts.app', [
    'subTitle' => 'Users',
    'pageTitle' => 'Add New User'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                        @csrf

                        <strong class="text-muted d-block my-2">Personal Detail</strong>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input id="first_name" type="text" placeholder="First Name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <input id="middle_name" type="text" placeholder="Middle Name" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" value="{{ old('middle_name') }}" required>

                                @if ($errors->has('middle_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <input id="last_name" type="text" placeholder="Last Name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="input-group input-group-seamless">
                                    <input id="personal_email" type="text" placeholder="Personal Mail" class="form-control{{ $errors->has('personal_email') ? ' is-invalid' : '' }}" name="personal_email" value="{{ old('personal_email') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('personal_email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('personal_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="mobile_no" type="text" placeholder="Mobile Number" class="form-control{{ $errors->has('mobile_no') ? ' is-invalid' : '' }}" name="mobile_no" value="{{ old('mobile_no') }}" required>

                                @if ($errors->has('mobile_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="dob" placeholder="Date of birth" type="text" class="form-control input-date{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required>

                                @if ($errors->has('dob'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <textarea id="address" placeholder="Address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required>{{ old('address') }}</textarea>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <strong class="text-muted d-block my-2">Account Detail</strong>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input id="username" placeholder="Username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="input-group input-group-seamless">
                                    <input id="email" placeholder="Email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <strong class="text-muted d-block my-2">Social Detail</strong>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="input-group input-group-seamless">
                                    <input id="skype" placeholder="Skype" type="text" class="form-control{{ $errors->has('skype') ? ' is-invalid' : '' }}" name="skype" value="{{ old('skype') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fab fa-skype"></i>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('skype'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="input-group input-group-seamless">
                                    <input id="trello" placeholder="Trello" type="text" class="form-control{{ $errors->has('trello') ? ' is-invalid' : '' }}" name="trello" value="{{ old('trello') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fab fa-trello"></i>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('trello'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('trello') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="input-group input-group-seamless">
                                    <input id="slack" placeholder="Slack" type="password" class="form-control{{ $errors->has('slack') ? ' is-invalid' : '' }}" name="slack" value="{{ old('slack') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fab fa-slack"></i>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('slack'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('slack') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="input-group input-group-seamless">
                                    <input id="github" placeholder="Github" type="text" class="form-control{{ $errors->has('github') ? ' is-invalid' : '' }}" name="github" value="{{ old('github') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fab fa-github"></i>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('github'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('github') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="input-group input-group-seamless">
                                    <input id="twitter" placeholder="Twitter" type="text" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" name="twitter" value="{{ old('twitter') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fab fa-twitter"></i>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('twitter'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="input-group input-group-seamless">
                                    <input id="linkedin" placeholder="Linkedin" type="password" class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" name="linkedin" value="{{ old('linkedin') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fab fa-linkedin"></i>
                                        </div>
                                    </div>
                                </div>

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

                                <a class="btn btn-link" href="/users">
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