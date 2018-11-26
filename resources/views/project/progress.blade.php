@extends('layouts.app', [
    'subTitle' => 'Projects',
    'pageTitle' => 'Add Project Progress'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
                    {{ html()->form('POST', route('progress'))
                        ->acceptsFiles()
                        ->open() }}

                    {{ html()->hidden('project_id', $project->id) }}

                    <div class="form-group row">
                        {{ html()->label('Description')
                                    ->for('description')
                                    ->class('col-sm-2 col-form-label text-md-right')
                         }}

                        <div class="col-md-6">
                            {{ html()->textarea('description')
                                    ->placeholder('Description')
                                    ->class(['form-control', 'is-invalid' => $errors->has('description')])
                                    ->required()
                            }}

                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ html()->label('Date')
                                    ->for('date')
                                    ->class('col-sm-2 col-form-label text-md-right')
                         }}
                        <div class="col-md-6">
                            <div class="input-group input-group-seamless">
                                {{ html()->text('date')
                                        ->placeholder('Date')
                                        ->class(['form-control input-date', 'is-invalid' => $errors->has('date')])
                                }}
                            </div>

                            @if ($errors->has('date'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('date') }}</strong>
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
                                   ->href('/projects')
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