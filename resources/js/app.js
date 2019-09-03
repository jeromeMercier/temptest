/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuetify = require('vuetify');

import VueInternationalization from 'vue-i18n';
import Locale from '../assets/js/vue-i18n-locales.generated'

Vue.use(VueInternationalization);

const i18n = new VueInternationalization({
    locale: 'fr', // set locale
    fallbackLocale: 'en', // set fallback locale
    messages: Locale, // set locale messages
});



Vue.use(Vuetify)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('myjob-navbar', require('./components/MyjobNavbar.vue').default);
Vue.component('myjob-home', require('./components/MyjobHome.vue').default);
Vue.component('myjob-faq', require('./components/MyjobFaq.vue').default);
Vue.component('myjob-contact', require('./components/MyjobContact.vue').default);
Vue.component('myjob-footer', require('./components/MyjobFooter.vue').default);
Vue.component('myjob-ad-index', require('./components/MyjobAdIndex.vue').default);
Vue.component('myjob-new-ad', require('./components/MyjobNewAd.vue').default);
Vue.component('myjob-options', require('./components/MyjobOptions.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.mixin({
    methods: {
        redirect(value) {
            window.location.href = value;
        },
        changeLocale(language){
          this.$i18n.locale = language
        }
    }
})
const app = new Vue({
    el: '#app',
    i18n
});
