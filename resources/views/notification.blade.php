@if($notification->type === 'App\Notifications\HolidayAdded')
    <a href="{{ url('holidays', $notification->data['id']) }}">
        <span class="text-shuttle-gray">Holiday Alert</span>
        <p class="mb-0">We have Holiday for {{ array_get($notification->data, 'title') }} from
            <span class="text-reagent-gray text-semibold">{{ array_get($notification->data, 'start_date') }}</span> To
            <span class="text-reagent-gray text-semibold">{{ array_get($notification->data, 'end_date') }}</span>
        </p>
    </a>
@elseif($notification->type === 'App\Notifications\LeaveRequested')
    <a href="{{ url('leaves', $notification->data['id']) }}">
        <span class="text-shuttle-gray">Leave Request</span>
        <p class="mb-0">Your have requestd for leave for {{ array_get($notification->data, 'subject') }} from
            <span class="text-reagent-gray text-semibold">{{ array_get($notification->data, 'start_date') }}</span> To
            <span class="text-reagent-gray text-semibold">{{ array_get($notification->data, 'end_date') }}</span>
        </p>
    </a>
@elseif($notification->type === 'App\Notifications\LeaveApproval')
    <a href="{{ url('leaves', $notification->data['id']) }}">
        <span class="text-shuttle-gray">Leave Approval Alert</span>
        <p class="mb-0">Your Leave request for {{ array_get($notification->data, 'subject') }} from
            <span class="text-reagent-gray text-semibold">{{ array_get($notification->data, 'start_date') }}</span> To
            <span class="text-reagent-gray text-semibold">{{ array_get($notification->data, 'end_date') }}</span>
            is {{ array_get($notification->data, 'approval_status') }}
        </p>
    </a>
@elseif($notification->type === 'App\Notifications\SalaryPaid')
    <a href="{{ url('salaries', $notification->data['user_id']) }}">
        <span class="text-shuttle-gray">Salary Paid Alert</span>
        <p class="mb-0">Your Salary {{ array_get($notification->data, 'paid_amount') }} is paid fpr
            <span class="text-reagent-gray text-semibold">{{ array_get($notification->data, 'paid_for') }}</span>
        </p>
    </a>
@endif