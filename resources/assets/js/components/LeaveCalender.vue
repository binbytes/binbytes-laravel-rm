<template>
    <div>
        <transition name="fade">
            <leave-detail v-if="event" :leave="event.originalEvent" @refresh-leave="getLeaves"></leave-detail>
        </transition>

        <calendar-view
                :show-date="showDate"
                :events="leaves"
                @click-event="clickEvent"
                class="theme-default holiday-us-traditional holiday-us-official">
            <calendar-view-header
                    slot="header"
                    slot-scope="{ headerProps }"
                    :header-props="headerProps"
                    @input="setShowDate" />
        </calendar-view>
    </div>
</template>

<script>
import { CalendarView, CalendarViewHeader } from 'vue-simple-calendar'
import LeaveDetail from './LeaveDetail'

export default {
    components: {
        CalendarView,
        CalendarViewHeader,
        LeaveDetail
    },
    data () {
        return {
            event: null,
            showDate: null,
            leaves: []
        }
    },
    mounted() {
        this.getLeaves()
    },
    methods: {
        getLeaves() {
            axios.get('/api-leaves').then(({ data }) => {
                this.leaves = data.data.map(function (leave) {
                    let cssClass = 'bg-warning'

                    if(leave.isApproved === true) {
                        cssClass = 'bg-success'
                    } else if(leave.isApproved === false) {
                        cssClass = 'bg-danger'
                    }

                    leave.classes = cssClass.concat(' text-white')

                    return leave
                })

                this.event = null
            })
        },
        setShowDate(d) {
            this.showDate = d
        },
        clickEvent(e) {
            this.event = e
        }
    }
}
</script>