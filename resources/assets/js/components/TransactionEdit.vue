<template>
    <div class="mb-4">
        <input type="hidden" id="transaction-edit-id" class="d-none" :value="id" @input="event => id = event.target.value" />

        <d-modal v-if="showModal" size="lg" @close="handleClose">
            <d-modal-header>
                <d-modal-title>Transaction</d-modal-title>
            </d-modal-header>
            <d-form v-if="form" @submit="handleOnSubmit" class="text-muted" enctype="multipart/form-data">
                <d-modal-body class="pb-0">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="small mb-0">Account</label>
                            <d-form-select v-model="form.account_id"
                                           name="account_id"
                                           :options="accounts"
                                           :class="{ 'is-invalid': form.errors.has('account_id') }" />
                            <span class="invalid-feedback text-left" v-if="form.errors.has('account_id')">
                                <strong v-html="form.errors.first('account_id')"></strong>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-0">Sequence Number</label>
                            <input v-model="form.sequence_number" type="text" name="sequence_number" placeholder="Sequence No" class="form-control" :class="{ 'is-invalid': form.errors.has('sequence_number') }" autofocus>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('sequence_number')">
                                <strong v-html="form.errors.first('sequence_number')"></strong>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-0">Date</label>
                            <d-datepicker
                                v-model="form.date"
                                name="date"
                                :input-class="['form-control', {'is-invalid' : form.errors.has('date') }]"
                                typeable />

                            <span class="invalid-feedback text-left" v-if="form.errors.has('date')">
                                <strong v-html="form.errors.first('date')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="small mb-0">Description</label>
                            <textarea v-model="form.description" name="description" placeholder="Description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('description')">
                                <strong v-html="form.errors.first('description')"></strong>
                            </span>
                        </div>

                        <div class="col-md-6">
                            <label class="small mb-0">Reference</label>
                            <textarea v-model="form.reference" name="reference" placeholder="Reference" class="form-control" :class="{ 'is-invalid': form.errors.has('reference') }"></textarea>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('reference')">
                                <strong v-html="form.errors.first('reference')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="small mb-0">Credit Amount</label>
                            <input v-model="form.credit_amount" type="text" name="credit_amount" placeholder="Credit Amount" class="form-control" :class="{ 'is-invalid': form.errors.has('credit_amount') }">
                            <span class="invalid-feedback text-left" v-if="form.errors.has('credit_amount')">
                                <strong v-html="form.errors.first('credit_amount')"></strong>
                            </span>
                        </div>

                        <div class="col-md-4">
                            <label class="small mb-0">Debit Amount</label>
                            <input v-model="form.debit_amount" type="text" name="debit_amount" placeholder="Debit Amount" class="form-control" :class="{ 'is-invalid': form.errors.has('debit_amount') }">
                            <span class="invalid-feedback text-left" v-if="form.errors.has('debit_amount')">
                                <strong v-html="form.errors.first('debit_amount')"></strong>
                            </span>
                        </div>

                        <div class="col-md-4">
                            <label class="small mb-0">Closing Balance</label>
                            <input v-model="form.closing_balance" type="text" name="closing_balance" placeholder="Closing Balance" class="form-control" :class="{ 'is-invalid': form.errors.has('closing_balance') }">
                            <span class="invalid-feedback text-left" v-if="form.errors.has('closing_balance')">
                                <strong v-html="form.errors.first('closing_balance')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="small mb-0">Type</label>
                            <d-form-select
                                    v-model="form.type"
                                    name="type"
                                    :options="filterTransactionType"
                                    value-field="id"
                                    text-field="title"
                                    :class="{ 'is-invalid': form.errors.has('type') }"
                                    @change="changeType" />
                            <span class="invalid-feedback text-left" v-if="form.errors.has('type')">
                                <strong v-html="form.errors.first('type')"></strong>
                            </span>
                        </div>

                        <div class="col-md-4">
                            <label class="small mb-0">Transactional Type</label>
                            <d-form-select
                                    v-model="form.transactional_type"
                                    name="transactional_type"
                                    :options="transactionalTypes"
                                    :class="{ 'is-invalid': form.errors.has('transactional_type') }" />
                            <span class="invalid-feedback text-left" v-if="form.errors.has('transactional_type')">
                                <strong v-html="form.errors.first('transactional_type')"></strong>
                            </span>
                        </div>

                        <div class="col-md-4">
                            <label class="small mb-0">Transactional Id</label>
                            <d-form-select
                                    v-model="form.transactional_id"
                                    name="transactional_id"
                                    :options="filterTransactionalId"
                                    :class="{ 'is-invalid': form.errors.has('transactional_id') }" />
                            <span class="invalid-feedback text-left" v-if="form.errors.has('transactional_id')">
                                <strong v-html="form.errors.first('transactional_id')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8">
                            <label class="small mb-0">Note</label>
                            <textarea v-model="form.note" name="note" placeholder="Note" class="form-control" :class="{ 'is-invalid': form.errors.has('note') }"></textarea>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('note')">
                                <strong v-html="form.errors.first('note')"></strong>
                            </span>
                        </div>

                        <div class="col-md-4">
                            <label class="small mb-0">Invoice</label>
                            <input ref="input_invoice" name="invoice" @change="handleInvoice" class="d-none" type="file">

                            <button type="button" class="form-control d-flex" @click="selectImage" :class="{ 'is-invalid': form.errors.has('invoice') }">
                                <i class="fas fa-file-upload fa-2x"></i>
                                <span class="flex-grow-1 text-truncate" v-text="form.invoice.name"></span>
                            </button>
                        </div>
                    </div>

                </d-modal-body>
                <d-modal-footer>
                    <input name="_method" type="hidden" v-model="form._method" class="d-none" value="PUT">
                    <button type="submit" id="edit-data" class="btn btn-primary" :disabled="isProcessing">Save</button>
                    <button type="reset" @click="handleClose" class="btn btn-link" :disabled="isProcessing">Cancel</button>
                </d-modal-footer>
            </d-form>
        </d-modal>
    </div>
</template>

<script>
    import Form from 'form-backend-validation'

    export default {
        props: [
            'clients', 'users', 'projects'
        ],
        data() {
            return {
                id: null,
                accounts: null,
                transactionTypes: [],
                isProcessing: false,
                showModal: false,
                form: null,
                transactionalTypes: []
            }
        },
        watch: {
            id() {
               this.fetchTransaction()
            }
        },
        computed: {
            filterTransactionType() {
                let types = [];
                for(let i = 0 ; i < this.transactionTypes.length; i++) {
                    let type = this.form.credit_amount > 0 ? 'credit' : 'debit'
                    if(this.transactionTypes[i].transaction_type === type
                        || this.transactionTypes[i].transaction_type === 'both') {
                        types.push(this.transactionTypes[i]);
                    }
                }

                return types;
            },

            filterTransactionalId() {
                let data = null;

                if(this.form.transactional_type === '\\App\\User') {
                    data = this.users;
                } else if(this.form.transactional_type === '\\App\\Client') {
                    data = this.clients;
                } else {
                    data = this.projects
                }

                return data;
            }
        },
        mounted() {
            this.fetchInitialData()
        },
        methods: {
            changeValue(val) {
                this.id = val.target.value
            },
            selectImage() {
                this.$refs['input_invoice'].click()
            },
            handleInvoice(event) {
                if(event.target.files) {
                    this.form.invoice = event.target.files[0]
                }
            },
            fetchInitialData() {
                axios.get('/api-accounts').then(res => {
                    this.accounts = res.data.accounts
                    this.transactionTypes = res.data.transactionTypes
                    this.transactionalTypes = res.data.transactionalTypes
                })
            },
            fetchTransaction() {
                if(!this.id) return;

                axios.get('/transactions/' + this.id)
                    .then(res => {
                        let transaction = res.data.transaction
                        this.form = new Form({
                            account_id: transaction.account_id,
                            sequence_number: transaction.sequence_number,
                            date: transaction.date,
                            description: transaction.description,
                            reference: transaction.reference,
                            credit_amount: transaction.credit_amount,
                            debit_amount: transaction.debit_amount,
                            closing_balance: transaction.closing_balance,
                            note: transaction.note,
                            invoice: '',
                            type: transaction.type,
                            transactional_type: transaction.transactional_type,
                            transactional_id: transaction.transactional_id,
                            _method: 'PUT'
                        })
                        this.showModal = true
                    })
            },
            handleOnSubmit(e) {
                e.preventDefault();
                this.isProcessing = true
                this.form._method = 'PUT';
                this.form.post(`/transactions/${this.id}`).then(response => {
                    this.isProcessing = false
                    this.showModal = false
                    this.id = null
                    //window.location.reload()
                }).catch(() => {
                    this.isProcessing = false
                })
            },
            handleClose() {
                this.showModal = false
                this.id = null
            },
            changeType(id) {
                let transation = this.transactionTypes.find(x => x.id === id)

                $.each(this.transactionalTypes, (key) => {
                    if(key === transation.model_name)
                        this.form.transactional_type = key
                });
            }
        }
    }
</script>