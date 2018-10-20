@extends('layouts.app', [
    'subTitle' => 'Clients',
    'pageTitle' => 'Add New Client'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('clients.store') }}">
                        @csrf

                        <strong class="text-muted d-block my-2">Personal Detail</strong>
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
                                <div class="input-group input-group-seamless">
                                    <input id="dob" placeholder="Date of Birth" type="text" class="form-control input-date{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

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
                                <select id="timezone" placeholder="Timezone" class="form-control{{ $errors->has('timezone') ? ' is-invalid' : '' }}" name="timezone">
                                    @foreach(timeZoneList() as $timezone)
                                        <option>{{ $timezone }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('timezone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('timezone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <strong class="text-muted d-block my-2">Account Detail</strong>
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