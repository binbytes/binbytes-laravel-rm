<div class="form-group row">
    <div class="col-md-5">
        {{ html()->text('name')
                ->placeholder('Name')
                ->class(['form-control', 'is-invalid' => $errors->has('name')])
                ->required()
                ->autofocus()
        }}

        @if ($errors->has('name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-5">
        {{ html()->select('user_id')
                ->placeholder('Select User')
                ->class(['custom-select', 'is-invalid' => $errors->has('user_id')])
                ->options($users)
                ->value(old('user_id', isset($account) ? $account->user_id : ''))
                ->required()
        }}

        @if ($errors->has('user_id'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('user_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-10">
        {{ html()->textarea('address')
                ->placeholder('Address')
                ->class(['form-control', 'is-invalid' => $errors->has('address')])
                ->required()
        }}

        @if ($errors->has('address'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-5">
        {{ html()->select('bank_name')
                ->placeholder('Select Bank')
                ->class(['custom-select', 'is-invalid' => $errors->has('bank_name')])
                ->options(config('rm.banks'))
                ->value(old('bank_name', isset($account) ? $account->bank_name : ''))
                ->required()
        }}

        @if ($errors->has('bank_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('bank_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-5">
        {{ html()->text('account_number')
                ->placeholder('Account Number')
                ->class(['form-control', 'is-invalid' => $errors->has('account_number')])
        }}

        @if ($errors->has('account_number'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('account_number') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-5">
        {{ html()->text('branch_of')
                ->placeholder('Branch of')
                ->class(['form-control', 'is-invalid' => $errors->has('branch_of')])
        }}

        @if ($errors->has('branch_of'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('branch_of') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-5">
        {{ html()->text('ifsc_code')
                ->placeholder('IFSC Code')
                ->class(['form-control', 'is-invalid' => $errors->has('ifsc_code')])
        }}

        @if ($errors->has('ifsc_code'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('ifsc_code') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-5">
        {{ html()->text('contact_number')
                ->placeholder('Contact Number')
                ->class(['form-control', 'is-invalid' => $errors->has('contact_number')])
        }}

        @if ($errors->has('contact_number'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('contact_number') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-5">
        {{ html()->text('statement_starting_line')
                ->placeholder('Statement Starting Line')
                ->type('number')
                ->class(['form-control', 'is-invalid' => $errors->has('statement_starting_line')])
        }}

        @if ($errors->has('statement_starting_line'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('statement_starting_line') }}</strong>
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
               ->href('/accounts')
               ->text('Cancel')
               ->class('btn btn-link')
        }}
    </div>
</div>