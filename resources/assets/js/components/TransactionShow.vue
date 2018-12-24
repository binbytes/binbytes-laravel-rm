<template>
    <div class="mb-4">
        <d-modal v-if="showModal" @close="handleClose">
            <d-modal-header>
                <d-modal-title>Transaction Detail</d-modal-title>
            </d-modal-header>
            <d-form @submit="handleOnSubmit">
                <d-modal-body>
                    <div class="row mb-2">
                        <div class="col-6">
                            <span>Sequence No: {{ form.sequence_number }}</span>
                        </div>
                        <div class="col-6">
                            <span>Date: {{ form.date }}</span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <span>Reference: {{ form.reference }}</span>
                        </div>
                        <div class="col-6">
                            <span>Type: {{ form.type }}</span>
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
                            <span class="text-success">{{ form.credit_amount }}</span>
                        </div>
                        <div class="col-4">
                            <span class="text-danger">{{ form.debit_amount }}</span>
                        </div>
                        <div class="col-4">
                            <span class="text-info">{{ form.closing_balance }}</span>
                        </div>
                    </div>
                </d-modal-body>
            </d-form>
        </d-modal>
    </div>
</template>

<script>
    import Form from 'form-backend-validation'

    export default {
        props: [
            'openModal'
        ],
        data() {
            return {
                form: new Form({
                    account_id:'',
                    sequence_number:'',
                    date:'',
                    description: '',
                    reference:'',
                    credit_amount:'',
                    debit_amount:'',
                    closing_balance:'',
                    note:'',
                    invoice:'',
                    type:''
                }),
                isProcessing: false,
                showModal: false
            }
        },
        mounted() {
            this.form = new Form(this.transaction)
            this.showModal = true
        },
        methods: {
            handleClose() {
                this.showModal = false
            }
        }
    }
</script>