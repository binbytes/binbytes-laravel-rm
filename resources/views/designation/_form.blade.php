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

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        {{ html()->button('Save')
                ->type('submit')
                ->class('btn btn-primary')
         }}

        {{ html()->a()
               ->href('/designations')
               ->text('Cancel')
               ->class('btn btn-link')
         }}
    </div>
</div>