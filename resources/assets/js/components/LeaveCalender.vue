<template>
    <div>
        <div v-if="event && event.originalEvent" class="mb-4">
            <div class="d-flex justify-content-between">
                <span>Name: {{ event.originalEvent.title }}</span>
                <span>Subject: {{ event.originalEvent.subject }}</span>
                <span>Description: {{ event.originalEvent.description }}</span>
                <div v-if="event.originalEvent.isApproved === null" class="text-right">
                    <div v-if="event.originalEvent.can_approve">
                        <button class="btn btn-success mr-3" @click="changeApproval(true)">
                            <i class="fas fa-check"> </i>
                            Approved
                        </button>
                        <button class="btn btn-danger" @click="changeApproval(false)">
                            <i class="fas fa-times"></i>
                            Declined
                        </button>
                    </div>

                    <span v-else>Approval Status: <strong class="badge badge-warning">{{ event.originalEvent.approvalStatus }}</strong></span>
                </div>
                <div v-else>
                    <h6>Approval Status: <strong :class="['badge', event.originalEvent.classes]">{{ event.originalEvent.approvalStatus }}</strong></h6>
                </div>
                <div>
                    <a v-if="event.originalEvent.can_edit"
                            :href="`/leaves/${event.originalEvent.id}/edit`"
                            class="btn btn-sm btn-white" aria-label="Edit">
                        <i class="fas fa-small fa-edit"></i>
                    </a>
                    <button v-if="event.originalEvent.can_delete"
                            @click="deleteLeave"
                            class="btn btn-sm btn-white"
                            aria-label="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
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
import { CalendarView, CalendarViewHeader }  from  'vue-simple-calendar'

export default {
    components: {
        CalendarView,
        CalendarViewHeader
    },
    data () {
        return {
            event: null,
            showDate: null,
            leaves: [],
            event: '',
            headerProps: {}
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
        },
        changeApproval(b) {
            axios.get(`leave-approval/${this.event.originalEvent.id}/${b}`).then(() => {
                this.getLeaves()
            })
        },
        deleteLeave() {
            axios.delete(`/leaves/${this.event.originalEvent.id}`).then(() => {
                this.getLeaves()
            })
        }
    }
}
</script>