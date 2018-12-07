/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

import appStore from './appStore.js'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('timer', require('./components/Timer.vue'));
Vue.component('avatar-selector', require('./components/AvatarSelector.vue'));
Vue.component('notifications', require('./components/Notifications.vue'));
Vue.component('project-list', require('./components/ProjectList.vue'));
Vue.component('holiday-calender', require('./components/HolidayCalender'));
Vue.component('leave-calender', require('./components/LeaveCalender'));

const app = new Vue({
    el: '#app',
    store: appStore,
    mounted() {
        //
    }
});
