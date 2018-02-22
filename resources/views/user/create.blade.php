@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">User</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="skype" class="col-sm-4 col-form-label text-md-right">Skype</label>

                                <div class="col-md-6">
                                    <input id="skype" type="text" class="form-control{{ $errors->has('skype') ? ' is-invalid' : '' }}" name="skype" value="{{ old('skype') }}">

                                    @if ($errors->has('skype'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="twitter" class="col-sm-4 col-form-label text-md-right">Twitter</label>

                                <div class="col-md-6">
                                    <input id="twitter" type="text" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" name="twitter" value="{{ old('twitter') }}">

                                    @if ($errors->has('twitter'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="linkedin" class="col-sm-4 col-form-label text-md-right">Linkedin</label>

                                <div class="col-md-6">
                                    <input id="linkedin" type="text" class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" name="linkedin" value="{{ old('linkedin') }}">

                                    @if ($errors->has('linkedin'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar</label>

                                <div class="col-md-6">
                                    <input name="avatar" id="avatar" type="file" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="remarks" class="col-md-4 col-form-label text-md-right">Remarks</label>

                                <div class="col-md-6">
                                    <textarea name="remarks" id="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}">{{ old('remarks') }}</textarea>

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