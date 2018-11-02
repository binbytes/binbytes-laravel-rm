<div class="form-group row">
    {{ html()->label('Title')
                ->for('title')
                ->class('col-sm-2 col-form-label text-md-right')
     }}

    <div class="col-md-4">
        {{ html()->text('title')
                ->placeholder('Title')
                ->class(['form-control', 'is-invalid' => $errors->has('title')])
                ->required()
                ->autofocus()
        }}

        @if ($errors->has('title'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

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
    {{ html()->label('Client')
                ->for('client_id')
                ->class('col-sm-2 col-form-label text-md-right')
    }}

    <div class="col-md-6">
        {{ html()->select('client_id')
                ->placeholder('---Select Client--')
                ->class(['custom-select', 'is-invalid' => $errors->has('client_id')])
                ->options($clients)
        }}

        @if ($errors->has('client_id'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('client_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ html()->label('Users')
                ->for('users')
                ->class('col-sm-2 col-form-label text-md-right')
    }}

    <div class="col-md-6">
        {{ html()->multiselect('users[]')
                ->placeholder('---Select Users--')
                ->class(['form-control', 'is-invalid' => $errors->has('users')])
                ->options($users->pluck('name', 'id'))
                ->value(old('users[]', isset($project) ? $project->users->pluck('id') : []))
        }}

        @if ($errors->has('users'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('users') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ html()->label('Remarks')
                ->for('remarks')
                ->class('col-sm-2 col-form-label text-md-right')
    }}

    <div class="col-md-6">
        {{ html()->textarea('remarks')
                ->placeholder('Remarks')
                ->class(['form-control', 'is-invalid' => $errors->has('address')])
        }}

        @if ($errors->has('remarks'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('remarks') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ html()->label('Priority')
                ->for('priority')
                ->class('col-sm-2 col-form-label text-md-right')
    }}

    <div class="col-md-6">
        {{ html()->select('priority')
                ->class('custom-select')
                ->options(priority())
        }}
    </div>
</div>

<div class="form-group row">
    {{ html()->label('Tags')
                ->for('tag')
                ->class('col-sm-2 col-form-label text-md-right')
    }}
    <div class="col-md-6">
        {{ html()->text('tag')
                ->class('form-control')
                ->attribute('data-role','tagsinput')
                ->value(old('tag', (isset($project->tags) ? implode(',', $project->tags->pluck('name')->toArray()) : '')))
         }}
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