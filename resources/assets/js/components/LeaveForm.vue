<template>
    <div class="mb-4">
        <d-modal v-if="showModal" @close="handleClose">
            <d-modal-header>
                <d-modal-title>Leave</d-modal-title>
            </d-modal-header>
            <d-form @submit="handleOnSubmit">
                <d-modal-body>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" v-model="form.subject" name="subject" placeholder="Subject" class="form-control" :class="{ 'is-invalid': form.errors.has('subject') }" autofocus>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('subject')">
                                <strong v-html="form.errors.first('subject')"></strong>
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
                        <div class="col-md-6">
                            <d-datepicker
                                    v-model="form.start_date"
                                    placeholder="Start Date"
                                    :input-class="['form-control', {'is-invalid' : form.errors.has('start_date') }]"
                                    typeable />

                            <span class="invalid-feedback text-left" v-if="form.errors.has('start_date')">
                                <strong v-html="form.errors.first('start_date')"></strong>
                            </span>
                        </div>

                        <div class="col-md-6">
                            <d-datepicker
                                    v-model="form.end_date"
                                    placeholder="End Date"
                                    :input-class="['form-control',{'is-invalid' : form.errors.has('end_date') }]"
                                    typeable />
                            <span class="invalid-feedback text-left" v-if="form.errors.has('end_date')">
                                <strong v-html="form.errors.first('end_date')"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <input v-model="form.start_date_partial_hours" type="text" name="start_date_partial_hours" placeholder="Start Partial Hours" class="form-control" :class="{ 'is-invalid': form.errors.has('start_date_partial_hours') }">
                            <span class="invalid-feedback text-left" v-if="form.errors.has('start_date_partial_hours')">
                                <strong v-html="form.errors.first('start_date_partial_hours')"></strong>
                            </span>
                        </div>

                        <div class="col-md-6">
                            <input v-model="form.end_date_partial_hours" type="text" name="end_date_partial_hours" placeholder="End Partial Hours" class="form-control" :class="{ 'is-invalid': form.errors.has('end_date_partial_hours') }">
                            <span class="invalid-feedback text-left" v-if="form.errors.has('end_date_partial_hours')">
                                <strong v-html="form.errors.first('end_date_partial_hours')"></strong>
                            </span>
                        </div>
                    </div>
                </d-modal-body>
                <d-modal-footer>
                    <div class="form-group row justify-content-center mb-0">
                        <button type="submit" class="btn btn-primary" :disabled="isProcessing">Save</button>
                        <button type="reset" @click="handleClose" class="btn btn-link">Cancel</button>
                    </div>
                </d-modal-footer>
            </d-form>
        </d-modal>
    </div>
</template>

<script>
import Form from 'form-backend-validation'

export default {
    props: [
        'leave',
        'showModal'
    ],
    data() {
        return {
            form: new Form({
                subject: '',
                description: '',
                start_date: '',
                end_date:'',
                start_date_partial_hours:'',
                end_date_partial_hours:''
            }),
            isProcessing: false,
        }
    },
    watch: {
        leave: {
            handler () {
                if(this.leave) {
                    this.form = new Form({
                        subject: this.leave.subject,
                        description: this.leave.description,
                        start_date: this.leave.startDate,
                        end_date: this.leave.endDate,
                        start_date_partial_hours: this.leave.start_date_partial_hours,
                        end_date_partial_hours: this.leave.end_date_partial_hours
                    })
                }
            },
            deep: true
        }
    },
    methods: {
        handleOnSubmit(e) {
            e.preventDefault();
            this.isProcessing = true

            if(this.leave) {
                this.form.put(`/leaves/${this.leave.id}`).then(response => {
                    this.isProcessing = false
                    this.$emit('close-modal')
                    this.$emit('refresh-leave')
                }).catch(() => {
                    this.isProcessing = false
                })
            } else {
                this.form.post('/leaves').then(response => {
                    this.isProcessing = false
                    this.$emit('refresh-leave')
                    this.$emit('close-modal')
                }).catch(() => {
                    this.isProcessing = false
                })
            }
        },
        handleClose() {
            this.$emit('close-modal')
        }
    }
}
</script>