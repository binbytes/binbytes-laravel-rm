<template>
    <div class="mb-4">
        <d-modal v-if="showModal" @close="handleClose">
            <d-modal-header>
                <d-modal-title>Transaction</d-modal-title>
            </d-modal-header>
            <d-form @submit="handleOnSubmit">
                <d-modal-body class="pb-0">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <d-form-select v-model="form.account_id" name="account_id" :options="accounts" :class="{ 'is-invalid': form.errors.has('account_id') }" />
                            <span class="invalid-feedback text-left" v-if="form.errors.has('account_id')">
                                <strong v-html="form.errors.first('account_id')"></strong>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <input v-model="form.sequence_number" type="text" name="sequence_number" placeholder="Sequence No" class="form-control" :class="{ 'is-invalid': form.errors.has('sequence_number') }" autofocus>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('sequence_number')">
                                <strong v-html="form.errors.first('sequence_number')"></strong>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <d-datepicker
                                    v-model="form.date"
                                    placeholder="Date"
                                    :name="date"
                                    :input-class="['form-control', {'is-invalid' : form.errors.has('date') }]"
                                    typeable />

                            <span class="invalid-feedback text-left" v-if="form.errors.has('date')">
                                <strong v-html="form.errors.first('date')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea v-model="form.description" name="description" placeholder="Description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('description')">
                                <strong v-html="form.errors.first('description')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea v-model="form.reference" name="reference" placeholder="Reference" class="form-control" :class="{ 'is-invalid': form.errors.has('reference') }"></textarea>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('reference')">
                                <strong v-html="form.errors.first('reference')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <input v-model="form.credit_amount" type="text" name="credit_amount" placeholder="Credit Amount" class="form-control" :class="{ 'is-invalid': form.errors.has('credit_amount') }">
                            <span class="invalid-feedback text-left" v-if="form.errors.has('credit_amount')">
                                <strong v-html="form.errors.first('credit_amount')"></strong>
                            </span>
                        </div>

                        <div class="col-md-6">
                            <input v-model="form.debit_amount" type="text" name="debit_amount" placeholder="Debit Amount" class="form-control" :class="{ 'is-invalid': form.errors.has('debit_amount') }">
                            <span class="invalid-feedback text-left" v-if="form.errors.has('debit_amount')">
                                <strong v-html="form.errors.first('debit_amount')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <input v-model="form.closing_balance" type="text" name="closing_balance" placeholder="Closing Balance" class="form-control" :class="{ 'is-invalid': form.errors.has('closing_balance') }">
                            <span class="invalid-feedback text-left" v-if="form.errors.has('closing_balance')">
                                <strong v-html="form.errors.first('closing_balance')"></strong>
                            </span>
                        </div>

                        <div class="col-md-6">
                            <d-form-select v-model="form.type" name="type" :options="transactionTypes" :class="{ 'is-invalid': form.errors.has('type') }" />
                            <span class="invalid-feedback text-left" v-if="form.errors.has('type')">
                                <strong v-html="form.errors.first('type')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea v-model="form.note" name="note" placeholder="Note" class="form-control" :class="{ 'is-invalid': form.errors.has('note') }"></textarea>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('note')">
                                <strong v-html="form.errors.first('note')"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input name="invoice" type="file" :class="{ 'is-invalid': form.errors.has('invoice') }">
                        </div>
                    </div>
                </d-modal-body>
                <d-modal-footer>
                    <button type="submit" class="btn btn-primary" :disabled="isProcessing">Save</button>
                    <button type="reset" @click="handleClose" class="btn btn-link">Cancel</button>
                </d-modal-footer>
            </d-form>
        </d-modal>
    </div>
</template>

<script>
    import Form from 'form-backend-validation'

    export default {
        props: [
          'accounts',
          'transaction',
          'transactionTypes'
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
        mounted(){
            this.form = new Form(this.transaction)
            this.showModal = true
        },
        methods: {
            getTransactions() {
                axios.get('/api-transactions', {
                }).then(({ data }) => {
                    this.transaction = data.data
                })
            },
            handleOnSubmit(e) {
                e.preventDefault();
                this.isProcessing = true
                this.form.put(`/transactions/${this.transaction.id}`).then(response => {
                    this.isProcessing = false
                    this.getTransactions()
                    this.showModal = false
                }).catch(() => {
                    this.isProcessing = false
                })
            },
            handleClose() {
                this.showModal = false
            }
        }
    }
</script>