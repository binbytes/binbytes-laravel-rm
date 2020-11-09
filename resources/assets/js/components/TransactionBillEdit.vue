<template>
  <div class="mb-4">
    <input type="hidden" id="invoice-bill-id" class="d-none" :value="id" @input="event => id = event.target.value" />

    <d-modal v-if="showModal" size="lg" @close="handleClose">
      <d-modal-header>
        <d-modal-title>Invoice Edit</d-modal-title>
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
          <div class="mr-auto">
            <d-checkbox inline v-model="billPdf" toggle>PDF Generate</d-checkbox>
          </div>
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
      billPdf: false
    }
  },
  watch: {
    id() {
      this.fetchInvoice()
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

    fetchInvoice() {
      if(!this.id) return;

      axios.get('/invoice/' + this.id)
          .then(res => {
            let invoice = res.data
            this.form.date = invoice.date
            this.form.amount = invoice.amount
            this.form.client_id = invoice.client_id
            this.form.project_id = invoice.project_id
            this.showModal = true
          })
    },
    handleOnSubmit(e) {
      e.preventDefault();
      this.isProcessing = true
      this.form._method = 'PUT';
      this.form.put(`/invoice/${this.id}`).then(response => {
        if(this.billPdf === true) {
          this.billPdf = false
          window.open(`/download-bill/${response.id}`, '_blank');
        }
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