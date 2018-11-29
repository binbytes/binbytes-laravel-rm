<div class="form-group row">
    <div class="col-md-5">
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
    <div class="col-md-10">
        {{ html()->textarea('description')
                ->placeholder('Description')
                ->class(['form-control', 'is-invalid' => $errors->has('description')])
        }}

        @if ($errors->has('description'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="input-daterange input-group input-date-range">
        <div class="col-md-5">
            {{ html()->text('start_date')
                    ->placeholder('Start Date')
                    ->class(['form-control input-date', 'is-invalid' => $errors->has('start_date')])
            }}

            @if ($errors->has('start_date'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-5">
            {{ html()->text('end_date')
                    ->placeholder('End Date')
                    ->class(['form-control input-date', 'is-invalid' => $errors->has('end_date')])
            }}

            @if ($errors->has('end_date'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('end_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="input-daterange input-group">
        <div class="col-md-5">
            {{ html()->text('start_date_partial_hours')
                    ->placeholder('Start Partial Hours')
                    ->class(['form-control', 'is-invalid' => $errors->has('start_date_partial_hours')])
            }}

            @if ($errors->has('start_date_partial_hours'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('start_date_partial_hours') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-5">
            {{ html()->text('end_date_partial_hours')
                    ->placeholder('End Partial Hours')
                    ->class(['form-control', 'is-invalid' => $errors->has('end_date_partial_hours')])
             }}
            @if ($errors->has('end_date_partial_hours'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('end_date_partial_hours') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        {{ html()->button('Save')
                ->type('submit')
                ->class('btn btn-primary')
         }}

        {{ html()->a()
               ->href('/holidays')
               ->text('Cancel')
               ->class('btn btn-link')
         }}
    </div>
</div>