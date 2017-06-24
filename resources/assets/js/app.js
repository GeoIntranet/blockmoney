
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery');
window.Tether = require('tether');

window.moment = require('moment');
require('./library/moment_local.js');
window.Form = require('./library/form.js');

window.axios = require('axios');

require('bootstrap');

window.Laravel = {
    csrfToken: $('meta[name=csrf-token]').attr("content")
};

window.Vue = require('vue');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('calendar', require('./components/Calendar.vue'));
Vue.component('transactions', require('./components/Transactions.vue'));
Vue.component('accounts', require('./components/Accounts.vue'));
Vue.component('account', require('./components/Account.vue'));
Vue.component('navigation', require('./components/Navigation.vue'));
Vue.component('compteSearch', require('./components/CompteSearch.vue'));
Vue.component('active_account', require('./components/ActiveAccount.vue'));
Vue.component('not_active_account', require('./components/NotActiveAccount.vue'));
Vue.component('transactionSearch', require('./components/TransactionSearch.vue'));
Vue.component('user_state', require('./components/user_state.vue'));

window.Event = new Vue();

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

const app = new Vue({
    el: '#app',
});
