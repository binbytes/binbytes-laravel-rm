<template>
    <div class="mb-4">
        <d-modal v-if="showModal" @close="handleClose">
            <d-modal-header>
                <d-modal-title>Holiday</d-modal-title>
            </d-modal-header>
            <d-form @submit="handleOnSubmit">
                <d-modal-body>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" v-model="form.title" name="title" placeholder="Title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" autofocus>
                            <span class="invalid-feedback text-left" v-if="form.errors.has('title')">
                                <strong v-html="form.errors.first('title')"></strong>
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
                                    :name="start_date"
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
                                    :name="end_date"
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
        'holiday',
        'showModal'
    ],
    data() {
        return {
            form: new Form({
                title: '',
                description: '',
                start_date: '',
                end_date: '',
                start_date_partial_hours: '',
                end_date_partial_hours: ''
            }),
            isProcessing: false
        }
    },
    watch: {
        holiday: {
            handler () {
                if(this.holiday) {
                    this.form = new Form({
                        title: this.holiday.title,
                        description: this.holiday.description,
                        start_date: this.holiday.startDate,
                        end_date: this.holiday.endDate,
                        start_date_partial_hours: this.holiday.start_date_partial_hours,
                        end_date_partial_hours: this.holiday.end_date_partial_hours
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

            if(this.holiday) {
                this.form.put(`/holidays/${this.holiday.id}`).then(response => {
                    this.isProcessing = false
                    this.$emit('refresh-holiday')
                    this.$emit('close-modal')
                }).catch(() => {
                    this.isProcessing = false
                })
            } else {
                this.form.post('/holidays').then(response => {
                    this.isProcessing = false
                    this.$emit('refresh-holiday')
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