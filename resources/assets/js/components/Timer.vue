<template>
    <div class="timer text-primary font-weight-bold">
        <span class="hours" v-text="hours"></span>
        :
        <span class="minutes" v-text="minutes"></span>
    </div>
</template>

<script>
    export default {
        name: 'timer',
        props: [
            'initialTime'
        ],
        mounted() {
            this.$store.commit('SET_INITIAL_TIME', this.initialTime),
            this.$store.dispatch('startTimer')
        },
        computed: {
            time() {
                return this.$store.state.time
            },
            hours() {
                return parseInt(this.time / 3600)
            },
            minutes() {
                return parseInt(this.time / 60) % 60
            }
        }
    }
</script>