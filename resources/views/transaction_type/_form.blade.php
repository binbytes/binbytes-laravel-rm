<div class="form-group row">
    {{ html()->label('Title')
                ->for('title')
                ->class('col-sm-3 col-form-label text-md-right')
    }}
    <div class="col-md-6">
        {{ html()->text('title')
                ->class(['form-control', 'is-invalid' => $errors->has('title')])
                ->required()
        }}
        @if ($errors->has('title'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {{ html()->label('Transaction Type')
                ->for('transaction_type')
                ->class('col-sm-3 col-form-label text-md-right')
    }}
    <div class="col-md-6">
        {{ html()->select('transaction_type')
                ->placeholder('Select Type')
                ->class(['custom-select', 'is-invalid' => $errors->has('transaction_type')])
                ->options(config('rm.transaction_type'))
                ->required()
        }}
        @if ($errors->has('transaction_type'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('transaction_type') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ html()->label('Parent Id')
                ->for('parent_id')
                ->class('col-sm-3 col-form-label text-md-right')
    }}
    <div class="col-md-6">
        {{ html()->select('parent_id')
                ->placeholder('Select Id')
                ->class(['custom-select', 'is-invalid' => $errors->has('parent_id')])
                ->options($transactionTypes)
        }}

        @if ($errors->has('parent_id'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('parent_id') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    {{ html()->label('Model Name')
                ->for('model_name')
                ->class('col-sm-3 col-form-label text-md-right')
    }}
    <div class="col-md-4">
        {{ html()->select('model_name')
                ->placeholder('Select Target Model Type')
                ->class(['custom-select', 'is-invalid' => $errors->has('model_name')])
                ->options(config('rm.target_models'))
        }}

        @if ($errors->has('model_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('model_name') }}</strong>
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
               ->href('/transaction-types')
               ->text('Cancel')
               ->class('btn btn-link')
         }}
    </div>
</div>