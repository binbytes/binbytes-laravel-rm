<template>
    <div v-if="leave" class="mb-4">
        <d-modal v-if="showModal" @close="handleClose">
            <d-modal-header>
                <d-modal-title>{{ leave.title }}</d-modal-title>
            </d-modal-header>
            <d-modal-body class="pb-1">
                <div class="row">
                    <span> For <strong class="text-info">{{leave.subject}}</strong>
                        From <d-badge pill theme="secondary">{{ leave.startDate }}</d-badge>
                        To <d-badge pill theme="secondary">{{ leave.endDate }}</d-badge>
                    </span>
                </div>

                <div class="row">
                    <p class="mt-3">{{ leave.description }}</p>
                </div>

                <div class="row justify-content-between">
                    <div v-if="leave.isApproved === null && leave.can_approve">
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
                        <h6 :class="classes">{{ leave.approvalStatus }}</h6>
                    </div>
                </div>
            </d-modal-body>
            <d-modal-footer>
                <d-btn v-if="leave.can_edit" @click="editLeave" class="btn btn-sm btn-primary mr-2">
                    <i class="fas fa-small fa-edit"></i>
                </d-btn>
                <button v-if="leave.can_delete"
                        @click="deleteLeave"
                        :disabled="isProcessing"
                        class="btn btn-sm btn-danger"
                        aria-label="Delete">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </d-modal-footer>
        </d-modal>
    </div>
</template>

<script>
import LeaveForm from "./LeaveForm";
export default {
    components: {LeaveForm},
    props: [
        'leave',
        'showModal'
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
        },
        handleClose() {
            this.$emit('close-modal')
        },
        editLeave() {
            this.$emit('edit-leave', this.leave)
        }
    }
}
</script>