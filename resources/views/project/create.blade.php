@extends('layouts.app', [
    'subTitle' => 'Projects',
    'pageTitle' => 'Add New Project'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label text-md-right">Title</label>

                            <div class="col-md-4">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required>{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="client_id" class="col-md-2 col-form-label text-md-right">Client</label>

                            <div class="col-md-6">
                                <select name="client_id" id="client_id" class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">---Select Client--</option>
                                    @foreach($clients as $id => $client)
                                        <option value="{{ $id }}">{{ $client }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('client_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('client_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="users" class="col-md-2 col-form-label text-md-right">Users</label>

                            <div class="col-md-6">
                                <select multiple name="users[]" id="users[]" class="form-control{{ $errors->has('users') ? ' is-invalid' : '' }}" required>
                                    <option value="">---Select Client--</option>
                                    @foreach($users as $id => $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('users'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('users') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remarks" class="col-md-2 col-form-label text-md-right">Remarks</label>

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

                                <a class="btn btn-link" href="/projects">
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