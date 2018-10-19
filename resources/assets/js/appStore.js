import Vue from 'vue'
window.Vuex = require('vuex')
Vue.use(Vuex)

let timer
const tickDuration = 10 // In seconds

const appStore = new Vuex.Store({
    state: {
        time: 0
    },
    mutations: {
        SET_INITIAL_TIME(state, time) {
            state.time = time
        },
        INCREMENT_TIMER(state) {
            state.time += tickDuration
        }
    },
    actions: {
        startTimer({ dispatch }) {
            if (!timer) {
                timer = setInterval(() => {
                    dispatch('logTime')
                }, tickDuration * 1000)
            }
        },
        logTime({ commit }) {
            axios.get('/attendance/ping')
                .then(() => {
                    commit('INCREMENT_TIMER')
                })
        }
    }
});

export default appStore