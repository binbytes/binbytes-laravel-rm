<strong class="text-muted d-block my-2">Personal Detail</strong>
<div class="form-group row">
    <div class="col-md-4 offset-md-8">
        <avatar-selector class="pull-right"></avatar-selector>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
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

    <div class="col-md-4">
        {{ html()->text('company_name')
                ->placeholder('Company Name')
                ->class(['form-control', 'is-invalid' => $errors->has('company_name')])
         }}

        @if ($errors->has('company_name'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('dob')
                    ->placeholder('Date of Birth')
                    ->class(['form-control input-date', 'is-invalid' => $errors->has('dob')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('dob'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        {{ html()->textarea('address')
                ->placeholder('Address')
                ->class(['form-control', 'is-invalid' => $errors->has('address')])
        }}

        @if ($errors->has('address'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        {{ html()->text('country')
                    ->placeholder('Country')
                    ->class(['form-control', 'is-invalid' => $errors->has('country')])
        }}

        @if ($errors->has('country'))
            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
        @endif
    </div>

    <div class="col-md-4">
        {{ html()->text('city')
                    ->placeholder('City')
                    ->class(['form-control', 'is-invalid' => $errors->has('city')])
        }}

        @if ($errors->has('city'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-4">
        {{ html()->select('timezone')
                ->placeholder('Timezone')
                ->class(['custom-select', 'is-invalid' => $errors->has('timezone')])
                ->options(timeZoneList())
        }}

        @if ($errors->has('timezone'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('timezone') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<strong class="text-muted d-block my-2">Account Detail</strong>
<div class="form-group row">
    <div class="col-md-4">
        {{ html()->text('mobile_no')
                ->placeholder('Mobile Number')
                ->class(['form-control', 'is-invalid' => $errors->has('mobile_no')])
        }}

        @if ($errors->has('mobile_no'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->email('email')
                ->placeholder('Email')
                ->class(['form-control', 'is-invalid' => $errors->has('email')])
                ->required()
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="far fa-envelope"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('email'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<strong class="text-muted d-block my-2">Social Detail</strong>
<div class="form-group row">
    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('skype')
                    ->placeholder('Skype')
                    ->class(['form-control', 'is-invalid' => $errors->has('skype')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fab fa-skype"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('skype'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('trello')
                    ->placeholder('Trello')
                    ->class(['form-control', 'is-invalid' => $errors->has('trello')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fab fa-trello"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('trello'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('trello') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('slack')
                    ->placeholder('Slack')
                    ->class(['form-control', 'is-invalid' => $errors->has('slack')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fab fa-slack"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('slack'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('slack') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('github')
                    ->placeholder('Github')
                    ->class(['form-control', 'is-invalid' => $errors->has('github')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fab fa-github"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('github'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('github') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('twitter')
                    ->placeholder('Twitter')
                    ->class(['form-control', 'is-invalid' => $errors->has('twitter')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fab fa-twitter"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('twitter'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('linkedin')
                    ->placeholder('Linkedin')
                    ->class(['form-control', 'is-invalid' => $errors->has('linkedin')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fab fa-linkedin"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('slack'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
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
               ->href('/clients')
               ->text('Cancel')
               ->class('btn btn-link')
         }}
    </div>
</div>