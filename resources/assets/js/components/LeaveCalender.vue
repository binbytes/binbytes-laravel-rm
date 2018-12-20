<template>
    <div>
        <div v-if="canCreate" class="text-right mb-3">
            <d-btn @click="addModal = true"><i class="fa fa-plus mr-2"></i>Add Leave</d-btn>
            <leave-form :showModal="addModal" :leave="leave"
                        @close-modal="closeModal" @refresh-leave="getLeaves"></leave-form>
        </div>

        <leave-detail v-if="event" :showModal="showModal" :leave="event.originalEvent"
                      @edit-leave="editLeave" @close-modal="closeModal" @refresh-leave="getLeaves"></leave-detail>
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
import LeaveForm from './LeaveForm'

export default {
    props: [
        'canCreate'
    ],
    components: {
        CalendarView,
        CalendarViewHeader,
        LeaveDetail,
        LeaveForm
    },
    data () {
        return {
            event: null,
            showDate: null,
            leaves: [],
            showModal: false,
            addModal: false,
            leave: null
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
            this.showModal = true
            this.event = e
        },
        closeModal() {
            this.addModal = false
            this.showModal = false
        },
        editLeave(leave) {
            this.leave = leave
            this.showModal = false
            this.addModal = true
        }
    }
}
</script>