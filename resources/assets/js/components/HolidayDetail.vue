<template>
    <div v-if="holiday" class="mb-4">
        <div class="d-flex justify-content-between">
            <span>Name: {{ holiday.title }}</span>
            <span>Description: {{ holiday.description }}</span>
            <span>Start Date: {{ holiday.startDate }}</span>
            <span>End Date: {{ holiday.endDate }}</span>
            <div>
                <a v-if="holiday.can_edit"
                   :href="`/holidays/${holiday.id}/edit`"
                   class="btn btn-sm btn-white" aria-label="Edit">
                    <i class="fas fa-small fa-edit"></i>
                </a>
                <button v-if="holiday.can_delete"
                        @click="deleteHoliday"
                        class="btn btn-sm btn-white"
                        aria-label="Delete">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'holiday'
        ],
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
            }
        }
    }
</script>