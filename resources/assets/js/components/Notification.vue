<template>
    <a v-if="notification.type == 'App\\Notifications\\HolidayAdded'" :class="cssClass" :href="`/holidays/${notification.data.id}`">
        <div class="notification__icon-wrapper">
            <div class="notification__icon">
                <i class="far fa-snowflake"></i>
            </div>
        </div>
        <div class="notification__content">
            <span class="notification__category">Holiday Alert</span>
            <p>We have Holiday for {{ notification.data.title }} from
                <span class="text-success text-semibold">{{ notification.data.start_date }}</span> To
                <span class="text-success text-semibold">{{ notification.data.end_date }}</span>
            </p>
        </div>
    </a>
    <a v-else-if="notification.type == 'App\\Notifications\\LeaveRequested'" :class="cssClass" @click="markAsRead" :href="`/leaves/${notification.data.id}`">
        <div class="notification__icon-wrapper">
            <div class="notification__icon">
                <i class="far fa-snowflake"></i>
            </div>
        </div>
        <div class="notification__content">
            <span class="notification__category">Leave Requested</span>
            <p>
                {{ notification.data.requested_by }} have requested for Leave from {{ notification.data.start_date }} to {{ notification.data.end_date }}
            </p>
        </div>
    </a>
    <a v-else-if="notification.type == 'App\\Notifications\\LeaveApproval'" :class="cssClass" @click="markAsRead" :href="`/leaves/${notification.data.id}`">
        <div class="notification__icon-wrapper">
            <div class="notification__icon">
                <i class="far fa-snowflake"></i>
            </div>
        </div>
        <div class="notification__content">
            <span class="notification__category">Leave Approval Alert</span>
            <p>Your Leave request for {{ notification.data.subject }} from
                <span class="text-success text-semibold">{{ notification.data.start_date }}</span> To
                <span class="text-success text-semibold">{{ notification.data.end_date }}</span>
                is {{ notification.data.approval_status }}
            </p>
        </div>
    </a>
    <div v-else>
        <a>Implement is missing. Work in progress.</a>
    </div>
</template>

<script>
export default {
    name: 'notification',
    props: [
        'notification'
    ],
    computed: {
        cssClass() {
            return ['dropdown-item', this.notification.read_at === null ? 'unread-notification' : '']
        }
    },
    methods: {
        markAsRead() {
            axios.get('/notifications/mark-read/' + this.notification.id).then(() => {
                //
            })
        }
    }
}
</script>