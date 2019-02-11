<template>
    <div class="mb-4">
        <input id="transaction-show-id" class="d-none" v-model="id"/>

        <d-modal v-if="showModal" @close="handleClose">
            <d-modal-header>
                <d-modal-title>Transaction Detail</d-modal-title>
            </d-modal-header>
            <d-form>
                <d-modal-body>
                    <div class="row mb-2">
                        <div class="col-6">
                            <span>Sequence No: {{ transition.sequence_number }}</span>
                        </div>
                        <div class="col-6">
                            <span>Date: {{ transition.date }}</span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <span>Reference: {{ transition.reference }}</span>
                        </div>
                        <div class="col-6">
                            <span>Type: {{ transition.type }}</span>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-4">
                            <span>Credit Amount</span>
                        </div>
                        <div class="col-4">
                            <span>Debit Amount</span>
                        </div>
                        <div class="col-4">
                            <span>Closing Balance</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <span class="text-success">₹ {{ transition.credit_amount }}</span>
                        </div>
                        <div class="col-4">
                            <span class="text-danger">₹ {{ transition.debit_amount }}</span>
                        </div>
                        <div class="col-4">
                            <span class="text-info">₹ {{ transition.closing_balance }}</span>
                        </div>
                    </div>
                </d-modal-body>
            </d-form>
            <d-modal-footer v-if="transition.note" v-text="transition.note" />
        </d-modal>
    </div>
</template>

<script>
    export default {
        watch: {
            id() {
                if(this.id) {
                    this.fetchData()
                }
            }
        },
        data() {
            return {
                id: null,
                isProcessing: false,
                showModal: false,
                transition: {}
            }
        },
        methods: {
            fetchData() {
                if(this.transition.id === this.id) {
                    this.showModal = true
                    return
                }

                axios.get('/transactions/' + this.id)
                    .then(res => {
                        this.transition = res.data
                        this.showModal = true
                    })
            },
            handleClose() {
                this.showModal = false
                this.id = null
            }
        }
    }
</script>