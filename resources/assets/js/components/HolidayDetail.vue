<template>
    <div v-if="holiday" class="mb-4">
        <d-modal v-if="showModal" @close="handleClose">
            <d-modal-header>
                <d-modal-title>{{ holiday.title }}</d-modal-title>
            </d-modal-header>

            <d-modal-body class="pb-0">
                <span>
                    From <d-badge pill theme="info">{{ holiday.startDate }}</d-badge>
                    To <d-badge pill theme="info">{{ holiday.endDate }}</d-badge>
                </span>
                <p class="mt-3">{{ holiday.description }}</p>
            </d-modal-body>
            <d-modal-footer>
                <d-btn v-if="holiday.can_edit" @click="editHoliday" class="btn btn-sm btn-primary mr-2">
                    <i class="fas fa-small fa-edit"></i>
                </d-btn>
                <button v-if="holiday.can_delete"
                        @click="deleteHoliday"
                        class="btn btn-sm btn-danger"
                        aria-label="Delete">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </d-modal-footer>
        </d-modal>
    </div>
</template>

<script>
import HolidayForm from './HolidayForm'

export default {
    props: [
        'holiday',
        'showModal'
    ],
    components: {
        HolidayForm
    },
    methods: {
        doRequest(endpoint, method = 'get') {
            axios({
                method: method,
                url: endpoint
            }).then(() => {
                this.$emit('refresh-holiday')
            })
        },
        deleteHoliday() {
            this.doRequest(`/holidays/${this.holiday.id}`, 'delete')
        },
        handleClose() {
            this.$emit('close-modal')
        },
        editHoliday() {
            this.$emit('edit-holiday', this.holiday)
        }
    }
}
</script>