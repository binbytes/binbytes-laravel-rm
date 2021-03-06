<strong class="text-muted d-block my-2">Personal Detail</strong>
<div class="form-group row">
    <div class="col-md-4 offset-md-8">
        <avatar-selector class="pull-right"></avatar-selector>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        {{ html()->text('first_name')
                ->placeholder('First Name')
                ->class(['form-control', 'is-invalid' => $errors->has('first_name')])
                ->required()
                ->autofocus()
        }}

        @if ($errors->has('first_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-4">
        {{ html()->text('middle_name')
                ->placeholder('Middle Name')
                ->class(['form-control', 'is-invalid' => $errors->has('middle_name')])
                ->required()
        }}

        @if ($errors->has('middle_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('middle_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-4">
        {{ html()->text('last_name')
                ->placeholder('Last Name')
                ->class(['form-control', 'is-invalid' => $errors->has('last_name')])
                ->required()
        }}

        @if ($errors->has('last_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->email('personal_email')
                ->placeholder('Personal Email')
                ->class(['form-control', 'is-invalid' => $errors->has('personal_email')])
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="far fa-envelope"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('personal_email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('personal_email') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-seamless">
            {{ html()->text('mobile_no')
                ->placeholder('Mobile Number')
                ->class(['form-control', 'is-invalid' => $errors->has('mobile_no')])
                ->required()
            }}
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa fa-phone"></i>
                </div>
            </div>
        </div>

        @if ($errors->has('mobile_no'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('mobile_no') }}</strong>
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
    <div class="col-md-4">
        {{ html()->select('designation_id')
                ->placeholder('-Select Designation-')
                ->class(['custom-select', 'is-invalid' => $errors->has('designation_id')])
                ->options($designations)
                ->value(old('designation_id', isset($user->designation) ? $user->designation->id : []))
        }}

        @if ($errors->has('designation_id'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('designation_id') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-8">
        {{ html()->text('address')
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
    <div class="col-md-8">
        {{ html()->textarea('about')
                ->placeholder('About')
                ->class(['form-control', 'is-invalid' => $errors->has('about')])
         }}

        @if ($errors->has('about'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('about') }}</strong>
            </span>
        @endif
    </div>
</div>

<strong class="text-muted d-block my-2">Account Detail</strong>
<div class="form-group row">
    <div class="col-md-4">
        {{ html()->text('username')
                ->placeholder('Username')
                ->class(['form-control', 'is-invalid' => $errors->has('username')])
                ->required()
        }}

        @if ($errors->has('username'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('username') }}</strong>
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

    <div class="col-md-4">
        {{ html()->password('password')
                ->placeholder('Password')
                ->class(['form-control', 'is-invalid' => $errors->has('password')])
                ->value('')
        }}

        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
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

        @if ($errors->has('linkedin'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('linkedin') }}</strong>
            </span>
        @endif
    </div>
</div>

@can('organizationDetail', \App\User::class)
<strong class="text-muted d-block my-2">Organizational</strong>
<div class="form-group row">
    <div class="col-md-6">
        {{ html()->text('joining_date')
                    ->placeholder('Joining Date')
                    ->class(['form-control input-date', 'is-invalid' => $errors->has('joining_date')])
                    ->required()
        }}

        @if ($errors->has('joining_date'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('joining_date') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6">
        {{ html()->text('leaving_date')
                    ->placeholder('Leaving Date (If left)')
                    ->class(['form-control input-date', 'is-invalid' => $errors->has('leaving_date')])
        }}

        @if ($errors->has('leaving_date'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('leaving_date') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        {{ html()->text('base_salary')
                ->placeholder('Base Salary (Per Month)')
                ->type('number')
                ->class(['form-control', 'is-invalid' => $errors->has('base_salary')])
        }}

        @if ($errors->has('base_salary'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('base_salary') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6">
        {{ html()->text('weekly_hours_credit')
                ->placeholder('Weekly Hours Credit')
                ->type('number')
                ->class(['form-control', 'is-invalid' => $errors->has('weekly_hours_credit')])
        }}

        @if ($errors->has('weekly_hours_credit'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('weekly_hours_credit') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        {{ html()->text('tds_amount')
                ->placeholder('TDS Amount')
                ->type('number')
                ->class(['form-control', 'is-invalid' => $errors->has('tds_amount')])
        }}

        @if ($errors->has('tds_amount'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('tds_amount') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6">
        {{ html()->text('professional_tax_amount')
                ->placeholder('Professional Tax Amount')
                ->type('number')
                ->class(['form-control', 'is-invalid' => $errors->has('professional_tax_amount')])
        }}

        @if ($errors->has('professional_tax_amount'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('professional_tax_amount') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-3">
        {{ html()->select('role')
                ->placeholder('Select Role')
                ->class(['custom-select', 'is-invalid' => $errors->has('role')])
                ->options(config('rm.roles'))
                ->value(old('role', isset($user->role) ? $user->role : []))
        }}

        @if ($errors->has('role'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('role') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-9">
        {{ html()->text('tag')
                ->class('form-control')
                ->placeholder('Tag')
                ->attribute('data-role', 'tagsinput')
                ->value(old('tag', (isset($user->tags) ? implode(',', $user->tags->pluck('name')->toArray()) : '')))
         }}
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

<div class="form-group row">
    <div class="col-md-4">
        <div class="custom-control custom-toggle custom-toggle-md">
            {{ html()->checkbox('is_active')
                    ->id('is_active')
                    ->class('custom-control-input')
            }}
            {{ html()->label('Is Active')
                    ->for('is_active')
                    ->class('custom-control-label')
            }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="custom-control custom-toggle custom-toggle-md">
            {{ html()->checkbox('exclude_from_salary')
                    ->id('exclude_from_salary')
                    ->class('custom-control-input')
            }}
            {{ html()->label('Exclude From Salary')
                    ->for('exclude_from_salary')
                    ->class('custom-control-label')
            }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="custom-control custom-toggle custom-toggle-md">
            {{ html()->checkbox('exclude_from_attendance')
                    ->id('exclude_from_attendance')
                    ->class('custom-control-input')
            }}
            {{ html()->label('Exclude From Attendance')
                    ->for('exclude_from_attendance')
                    ->class('custom-control-label')
            }}
        </div>
    </div>
</div>
@endcan

<div class="form-group">
    <div class="custom-control custom-toggle custom-toggle-md">
        {{ html()->checkbox('use_icon_sidebar')
                ->id('use_icon_sidebar')
                ->class('custom-control-input')
        }}
        {{ html()->label('Use Icon Sidebar')
                ->for('use_icon_sidebar')
                ->class('custom-control-label')
        }}
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-5">
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