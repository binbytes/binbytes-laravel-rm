@if($notification->type === 'App\Notifications\HolidayAdded')
    <a class="dropdown-item" href="{{ url('holidays', $notification->data['id']) }}">
        <div class="notification__icon-wrapper">
            <div class="notification__icon">
                <i class="far fa-snowflake"></i>
            </div>
        </div>
        <div class="notification__content">
            <span class="notification__category">Holiday Alert</span>
            <p>We have Holiday for {{ array_get($notification->data, 'title') }} from
                <span class="text-success text-semibold">{{ array_get($notification->data, 'start_date') }}</span> To
                <span class="text-success text-semibold">{{ array_get($notification->data, 'end_date') }}</span>
            </p>
        </div>
    </a>
@endif

@if($notification->type === 'App\Notifications\LeaveApproval')
    <a class="dropdown-item" href="{{ url('leaves', $notification->data['id']) }}">
        <div class="notification__icon-wrapper">
            <div class="notification__icon">
                <i class="far fa-snowflake"></i>
            </div>
        </div>
        <div class="notification__content">
            <span class="notification__category">Leave Approval Alert</span>
            <p>Your Leave request for {{ array_get($notification->data, 'subject') }} from
                <span class="text-success text-semibold">{{ array_get($notification->data, 'start_date') }}</span> To
                <span class="text-success text-semibold">{{ array_get($notification->data, 'end_date') }}</span>
                is {{ array_get($notification->data, 'approval_status') }}
            </p>
        </div>
    </a>
@endif