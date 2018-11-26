@extends('layouts.app', [
'subTitle' => 'Users',
'pageTitle' => 'Promot User'
])

@section('content')
<div class="row">
    <div class="col-lg-9 col-md-12">
        <div class="card card-small mb-3">
            <div class="card-header border-bottom py-1 px-4">
                <div class="row align-items-center">
                    <div class="col-1">
                        @if($user->avatar)
                            <img src="{{ $user->avatar_url }}" class="avatar" alt="user-avatar">
                        @else
                            <span class="user-placeholder">{{ substr($user->name, 0, 2) }}</span>
                        @endif
                    </div>
                    <span class="d-none d-inline-block col-6 pl-0">{{ $user->name }}</span>
                </div>
            </div>
            <div class="card-body">
                {{ html()->form('POST', route('store-promote', $user))
                ->acceptsFiles()
                ->open() }}

                <div class="form-group row">
                    {{ html()->label('Designation')
                        ->for('designation')
                        ->class('col-md-2 col-form-label text-md-right')
                    }}
                    <div class="col-md-4">
                        {{ html()->select('designation_id')
                                ->placeholder('-Select Designation-')
                                ->class(['custom-select', 'is-invalid' => $errors->has('designation_id')])
                                ->options($designations)
                        }}

                        @if ($errors->has('designation_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('designation_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    {{ html()->label('Remarks')
                        ->for('remarks')
                        ->class('col-md-2 col-form-label text-md-right')
                    }}
                    <div class="col-md-9">
                        {{ html()->textarea('remarks')
                                ->placeholder('Remarks')
                                ->class(['form-control', 'is-invalid' => $errors->has('remarks')])
                         }}

                        @if ($errors->has('remarks'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('remarks') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        {{ html()->button('Save')
                                ->type('submit')
                                ->class('btn btn-primary')
                         }}

                        {{ html()->a()
                               ->href('/users')
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

@push('scripts')
<script src="{{ mix('js/tag.js') }}"></script>
@endpush