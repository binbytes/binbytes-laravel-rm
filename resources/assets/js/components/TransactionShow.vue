<template>
    <div class="mb-4">
        <input id="transaction-show-id" class="d-none" v-model="id"/>

        <d-modal v-if="showModal" size="lg" @close="handleClose">
            <d-modal-header>
                <d-modal-title>Transaction Detail</d-modal-title>
            </d-modal-header>
            <d-form>
                <d-modal-body>
                    <div class="row mb-3">
                        <div class="col-4">
                            <strong>Date:
                                <span class="text-muted font-weight-light ml-1" v-text="transaction.date"></span>
                            </strong>
                        </div>
                        <div class="col-4">
                            <strong>Reference:
                                <span class="text-muted font-weight-light ml-1" v-text="transaction.reference"></span>
                            </strong>
                        </div>
                        <div class="col-4">
                            <strong>Type:
                                <span class="text-muted font-weight-light ml-1"
                                      v-text="transaction.type ? transaction.transaction_type.title : null">
                                </span>
                            </strong>
                        </div>
                    </div>
                    <div class="d-flex mb-1">
                        <strong class="mr-2">Description:</strong>
                        <p class="flex-grow-1 text-muted font-weight-light" v-text="transaction.description"></p>
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
                            <span class="text-success">₹ {{ transaction.credit_amount }}</span>
                        </div>
                        <div class="col-4">
                            <span class="text-danger">₹ {{ transaction.debit_amount }}</span>
                        </div>
                        <div class="col-4">
                            <span class="text-info">₹ {{ transaction.closing_balance }}</span>
                        </div>
                    </div>
                    <div v-if="transactionalTypes.type" class="row mt-4">
                        <div class="col-12">
                            <strong>Transaction For:
                                <span class="text-muted font-weight-light mx-1" v-text="transactionalTypes.type"></span>
                                -
                                <span class="text-muted font-weight-light mx-1" v-text="transactionalTypes.person"></span>
                            </strong>
                        </div>
                    </div>
                </d-modal-body>
            </d-form>
            <d-modal-footer v-if="transaction.note"  class="justify-content-start" >
                <strong>Note:
                    <span class="text-muted font-weight-light ml-1" v-text="transaction.note"></span>
                </strong>
            </d-modal-footer>
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
                transaction: {},
                transactionalTypes: {}
            }
        },
        methods: {
            fetchData() {
                if(!this.id) {
                    return
                }

                if(this.transaction.id === this.id) {
                    this.showModal = true
                    return
                }

                axios.get('/transactions/' + this.id)
                    .then(res => {
                        this.transaction = res.data.transaction
                        this.transactionalTypes = res.data.transactionalTypes
                        this.showModal = true
                        console.log(this.transaction, this.transactionalTypes)
                    })
            },
            handleClose() {
                this.showModal = false
                this.id = null
            }
        }
    }
</script>