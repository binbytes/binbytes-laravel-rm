<template>
    <div>
        <a class="nav-link nav-link-icon text-center" href="#" role="button" id="notificationDropDown"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="nav-link-icon__wrapper">
                <i class="material-icons"></i>
                <span class="badge badge-pill badge-danger" v-text="unReadNotificationsCount"></span>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-small" aria-labelledby="notificationDropDown">
            <notification v-for="notification in notifications"
                          :key="notification.id"
                          :notification="notification"/>

            <a class="dropdown-item notification__all text-center" href="/all-notifications"> View all Notifications </a>
        </div>
    </div>
</template>

<script>
import Notification from "./Notification"

export default {
    name: 'notifications',
    props: [
        'authId'
    ],
    components: {
        Notification
    },
    data() {
        return {
            notifications: []
        }
    },
    computed: {
        unReadNotificationsCount() {
            return this.notifications.filter(x => x.read_at === null).length
        }
    },
    mounted() {
        this.fetchNotifications()
        this.bindEchoEvents()
    },
    methods: {
        bindEchoEvents() {
            if(window.Echo) {
                Echo.private(`App.User.${this.authId}`)
                    .notification((notification) => {
                        this.notifications.unshift(notification)
                    });
            }
        },
        fetchNotifications() {
            axios.get('/notifications/recent').then(({ data }) => {
                this.notifications = data
            })
        }
    }
}
</script>