require('./bootstrap');

window.Vue=require('vue');
Vue.component('client-page',require('./components/email/Client.vue').default);
Vue.component('admin-page',require('./components/email/Admin.vue').default);
Vue.component('detect-location',require('./components/email/DetectCountry').default);

const app=new Vue({
    el:'#app',
});
