<template>
    <div v-if="leave" class="mb-4">
        <div class="d-flex justify-content-between">
            <span>Name: {{ leave.title }}</span>
            <span>Subject: {{ leave.subject }}</span>
            <span>Description: {{ leave.description }}</span>
            <div v-if="leave.isApproved === null && leave.can_approve" class="text-right">
                <div v-if="leave.can_approve">
                    <button class="btn btn-success mr-3"
                            @click="changeApproval(1)"
                            :disabled="isProcessing">
                        <i class="fas fa-check"> </i>
                        Approved
                    </button>
                    <button class="btn btn-danger"
                            :disabled="isProcessing"
                            @click="changeApproval(0)">
                        <i class="fas fa-times"></i>
                        Declined
                    </button>
                </div>
            </div>
            <div v-else>
                <h6>Approval Status: <strong :class="classes">{{ leave.approvalStatus }}</strong></h6>
            </div>
            <div>
                <a v-if="leave.can_edit"
                   :href="`/leaves/${leave.id}/edit`"
                   class="btn btn-sm btn-white" aria-label="Edit">
                    <i class="fas fa-small fa-edit"></i>
                </a>
                <button v-if="leave.can_delete"
                        @click="deleteLeave"
                        :disabled="isProcessing"
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
        'leave'
    ],
    data() {
        return {
            isProcessing: false
        }
    },
    computed: {
        classes() {
            return [
                'badge',
                (this.leave.isApproved === true)
                    ? 'bg-success' : (this.leave.isApproved === false ? 'bg-danger' : 'bg-warning')
            ]
        }
    },
    methods: {
        doRequest(endpoint, method = 'get') {
            this.isProcessing = true
            axios({
                method: method,
                url: endpoint
            }).then(() => {
                this.$emit('refresh-leave')
                this.isProcessing = false
            }).catch(() => {
                this.isProcessing = false
            })
        },
        changeApproval(type) {
            this.doRequest(`/leave-approval/${this.leave.id}/${type}`)
        },
        deleteLeave() {
            this.doRequest(`/leaves/${this.leave.id}`, 'delete')
        }
    }
}
</script>