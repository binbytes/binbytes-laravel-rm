<template>
    <div class="timer">
        <span class="minutes" v-text="hours"></span>
        :
        <span class="minutes" v-text="minutes"></span>
        :
        <span class="seconds" v-text="seconds"></span>
        <span class="seconds"></span>
    </div>
</template>

<script>
    let timer
    export default {
        name: 'timer',
        data () {
            return {
                time: 0
            }
        },
        mounted() {
            this.startTimer()
        },
        computed: {
            hours() {
                return parseInt(this.time / 3600)
            },
            minutes() {
                return parseInt(this.time / 60) % 60
            },
            seconds() {
                return this.time % 60
            }
        },
        methods: {
            startTimer() {
                if (!timer) {
                    timer = setInterval( () => {
                        this.time++
                    }, 1000)
                }
            }
        }
    }
</script>

<style>
    .hours {
        font-size: 23px;
    }
    .minutes, .seconds {
        font-size: 20px;
    }
</style>