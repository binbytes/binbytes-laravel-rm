@if($notification->type === 'App\Notifications\HolidayAdded')
    <a href="{{ url('holidays', $notification->data['id']) }}">
        <span class="notification__category">Holiday Alert</span>
        <p class="mb-0">We have Holiday for {{ array_get($notification->data, 'title') }} from
            <span class="text-success text-semibold">{{ array_get($notification->data, 'start_date') }}</span> To
            <span class="text-success text-semibold">{{ array_get($notification->data, 'end_date') }}</span>
        </p>
    </a>
@elseif($notification->type === 'App\Notifications\LeaveRequested')
    <a href="{{ url('leaves', $notification->data['id']) }}">
        <span class="notification__category">Leave Request</span>
        <p class="mb-0">Your have requestd for leave for {{ array_get($notification->data, 'subject') }} from
            <span class="text-success text-semibold">{{ array_get($notification->data, 'start_date') }}</span> To
            <span class="text-success text-semibold">{{ array_get($notification->data, 'end_date') }}</span>
        </p>
    </a>
@elseif($notification->type === 'App\Notifications\LeaveApproval')
    <a href="{{ url('leaves', $notification->data['id']) }}">
        <span class="notification__category">Leave Approval Alert</span>
        <p class="mb-0">Your Leave request for {{ array_get($notification->data, 'subject') }} from
            <span class="text-success text-semibold">{{ array_get($notification->data, 'start_date') }}</span> To
            <span class="text-success text-semibold">{{ array_get($notification->data, 'end_date') }}</span>
            is {{ array_get($notification->data, 'approval_status') }}
        </p>
    </a>
@endif