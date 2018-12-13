<div class="form-group row">
    <div class="col-md-4">
        {{ html()->select('account_id')
                ->placeholder('-Select Account-')
                ->class(['custom-select', 'is-invalid' => $errors->has('account_id')])
                ->options($accounts)
                ->value(old('account_id', isset($transaction) ? $transaction->account_id : ''))
                ->required()
        }}
        @if ($errors->has('account_id'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('account_id') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-4">
        {{ html()->text('sequence_number')
                ->placeholder('Sequence Number')
                ->class(['form-control', 'is-invalid' => $errors->has('sequence_number')])
                ->required()
                ->autofocus()
        }}
        @if ($errors->has('sequence_number'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('sequence_number') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('date')
                    ->placeholder('Date')
                    ->class(['form-control input-date', 'is-invalid' => $errors->has('date')])
             }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        @if ($errors->has('date'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        {{ html()->text('description')
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
    <div class="col-md-6">
        {{ html()->text('reference')
                ->placeholder('Reference')
                ->class(['form-control', 'is-invalid' => $errors->has('reference')])
         }}
        @if ($errors->has('reference'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('reference') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('credit_amount')
                ->placeholder('Credit Amount')
                ->class(['form-control', 'is-invalid' => $errors->has('credit_amount')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-arrow-up" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        @if ($errors->has('credit_amount'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('credit_amount') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('debit_amount')
                ->placeholder('Debit Amount')
                ->class(['form-control', 'is-invalid' => $errors->has('debit_amount')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-arrow-down" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        @if ($errors->has('debit_amount'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('debit_amount') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('closing_balance')
                ->placeholder('Closing Balance')
                ->type('number')
                ->class(['form-control', 'is-invalid' => $errors->has('closing_balance')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-rupee-sign" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        @if ($errors->has('closing_balance'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('closing_balance') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-10">
        {{ html()->select('type')
                ->placeholder('Transaction Type')
                ->class(['custom-select', 'is-invalid' => $errors->has('type')])
                ->options($transactionTypes)
                ->value(old('type', isset($transaction->type) ? $transaction->type : ''))
                ->required()
        }}

        @if ($errors->has('type'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-10">
        {{ html()->textarea('note')
                ->placeholder('Note')
                ->class(['form-control', 'is-invalid' => $errors->has('note')])
         }}
        @if ($errors->has('note'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('note') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ html()->label('Invoice')
                ->for('invoice')
                ->class('col-md-2 col-form-label')
     }}
    <div class="col-md-7">
        {{ html()->file('invoice')
                ->class(['form-control', 'is-invalid' => $errors->has('invoice')])
         }}
        @if ($errors->has('invoice'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('invoice') }}</strong>
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
               ->href(url()->previous())
               ->text('Cancel')
               ->class('btn btn-link')
         }}
    </div>
</div>