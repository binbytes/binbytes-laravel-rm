<template>
    <div>
        <input id="start-date" name="start_date" type="hidden" value="">
        <input id="end-date" name="end_date" type="hidden" value="">
        <VueCtkDateTimePicker v-model="yourValue" format="YYYY-MM-DD" formatted="ll"
                              color="#9362ce" button-color="#9362ce"
                              range noClearButton/>
    </div>
</template>

<script>
    import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
    import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

    export default {
        name: 'date-time-picker',
        components: {
            VueCtkDateTimePicker
        },
        data () {
            return {
                yourValue: {
                    start: '',
                    end: ''
                }
            }
        },
        watch: {
            yourValue () {
                $("#start-date").val(this.yourValue.start);
                $("#end-date").val(this.yourValue.end);
            }
        },
        mounted () {
            let today = new Date();
            this.yourValue.start = this.formateDate(new Date(today.getFullYear(),today.getMonth()-6,today.getDate()))
            this.yourValue.end = this.formateDate(today)

            $("#start-date").val(this.yourValue.start)
            $("#end-date").val(this.yourValue.end)
        },
        methods: {
            formateDate(date) {
                let month = date.getMonth()+1
                return date.getFullYear() + '-' + month + '-' + date.getDate();
            }
        }
    }
</script>

<style>
    .field-input[data-v-a0144ed0] {
         height: calc(2.09375rem + 2px);
         min-height: calc(2.09375rem + 2px);
         width: 200px;
    }
    .field-label[data-v-a0144ed0] {
        top: 1px;
    }
</style>


