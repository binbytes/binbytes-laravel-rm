<template>
    <div>
        <div v-if="canCreate" class="text-right mb-3">
            <d-btn @click="addModal = true"><i class="fa fa-plus mr-2"></i>Add Holiday</d-btn>
            <holiday-form :showModal="addModal" :holiday="holiday"
                           @close-modal="closeModal" @refresh-holiday="getHolidays">
            </holiday-form>
        </div>

        <holiday-detail v-if="event" :showModal="showModal" :holiday="event.originalEvent"
                        @edit-holiday="editHoliday" @close-modal="closeModal" @refresh-holiday="getHolidays">
        </holiday-detail>

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
import HolidayDetail from './HolidayDetail'
import HolidayForm from './HolidayForm'

export default {
    props: [
        'canCreate'
    ],
    components: {
        CalendarView,
        CalendarViewHeader,
        HolidayDetail,
        HolidayForm
    },
    data () {
        return {
            showDate: null,
            event: null,
            holidays: [],
            headerProps: {},
            showModal: false,
            addModal: false,
            holiday: null
        }
    },
    mounted() {
        this.getHolidays()
    },
    methods: {
        getHolidays() {
            axios.get('/api-holidays').then(({ data }) => {
                this.holidays = data.data
                this.event = null
            })
        },
        setShowDate(d) {
            this.showDate = d
        },
        clickEvent(e) {
            this.showModal = true
            this.event = e
        },
        closeModal() {
            this.showModal = false
            this.addModal = false
        },
        editHoliday(e) {
            this.showModal = false
            this.addModal = true
            this.holiday = e
        }
    }
}
</script>