<template>
    <div>
        <calendar-view
                :show-date="showDate"
                :events="holidays"
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

export default {
    components: {
        CalendarView,
        CalendarViewHeader
    },
    data () {
        return {
            showDate: null,
            event: null,
            holidays: [],
            headerProps: {}
        }
    },
    mounted() {
        this.getHolidays()
    },
    methods: {
        getHolidays() {
            axios.get('/api-holidays').then(({ data }) => {
                this.holidays = data.data
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