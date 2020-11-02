<template>
  <div class="mb-4">
    <input type="hidden" id="transaction-bill-id" class="d-none" :value="id" @input="event => id = event.target.value" />

    <d-modal v-if="showModal" size="lg" @close="handleClose">
      <d-modal-header>
        <d-modal-title>Transaction</d-modal-title>
      </d-modal-header>
      <d-form v-if="form" @submit="handleOnSubmit" class="text-muted">
        <d-modal-body class="pb-0">
          <div class="form-group row">
            <div class="col-md-6">
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
            <div class="col-md-6">
              <label class="small mb-0">Amount</label>
              <input v-model="form.amount"
                     type="text"
                     name="amount"
                     placeholder="Amount"
                     class="form-control"
                     :class="{ 'is-invalid': form.errors.has('credit_amount') }">
              <span class="invalid-feedback text-left" v-if="form.errors.has('amount')">
                  <strong v-html="form.errors.first('amount')"></strong>
              </span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label class="small mb-0">Client</label>
              <d-form-select v-model="form.client_id"
                             name="client_id"
                             :options="clients"
                             :class="{ 'is-invalid': form.errors.has('client_id') }" >
                <option :value="null">Select Client</option>
              </d-form-select>
              <span class="invalid-feedback text-left" v-if="form.errors.has('client_id')">
                  <strong v-html="form.errors.first('client_id')"></strong>
              </span>
            </div>
            <div class="col-md-6">
              <label class="small mb-0">Project</label>
              <d-form-select v-model="form.project_id"
                             name="project_id"
                             :options="projects"
                             :class="{ 'is-invalid': form.errors.has('project_id') }" >
                <option :value="null">Select Project</option>
              </d-form-select>
              <span class="invalid-feedback text-left" v-if="form.errors.has('client_id')">
                  <strong v-html="form.errors.first('client_id')"></strong>
              </span>
            </div>
          </div>
        </d-modal-body>
        <d-modal-footer>
          <input name="_method" type="hidden" v-model="form._method" class="d-none" value="POST">
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
    'clients'
  ],
  data() {
    return {
      id: null,
      isProcessing: false,
      showModal: false,
      projects: [],
      form: new Form({
        date: '',
        amount: '',
        client_id: null,
        project_id: null
      }),
    }
  },
  watch: {
    id() {
      this.fetchTransaction()
    },
    'form.client_id': {
      handler (val) {
        this.getProject(val)
      },
      deep: true
    }
  },
  methods: {
    changeValue(val) {
      this.id = val.target.value
    },

    getProject(id) {
      axios.get('/client-project/' + id)
          .then(res => {
            this.projects = res.data
          })
    },

    fetchTransaction() {
      if(!this.id) return;

      axios.get('/transactions/' + this.id)
          .then(res => {
            let transaction = res.data.transaction
            this.form.date = transaction.date
            this.form.amount = transaction.credit_amount
            this.showModal = true
          })
    },
    handleOnSubmit(e) {
      e.preventDefault();
      this.isProcessing = true
      this.form._method = 'POST';
      this.form.post('/transactions/bill').then(response => {
        this.isProcessing = false
        this.showModal = false
        this.id = null
      }).catch(() => {
        this.isProcessing = false
      })
    },
    handleClose() {
      this.showModal = false
      this.id = null
    },
  }
}
</script>