require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.$ = window.jQuery = require('jquery');
window.noUiSlider = require('nouislider/dist/nouislider');
window.wNumb = require('wnumb/wNumb');
window.owlCarousel = require('owl.carousel/dist/owl.carousel');
require('jquery-mask-plugin/src/jquery.mask');
window.Fancybox = require('@fancyapps/ui');
require('./libs/tabs');
require('./libs/chosen/chosen');
require('./functions');

//vue
import Vue from 'vue'

import { ZiggyVue } from 'ziggy';
import { Ziggy } from '../../js/ziggy';

Vue.use(ZiggyVue, Ziggy);

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers['Content-Type'] = 'application/json';

Vue.component('block-slider', require('./vue/common/BlockSlider').default);
Vue.component('block-select', require('./vue/common/BlockSelect').default);
Vue.component('block-input', require('./vue/common/BlockInput').default);
Vue.component('block-date', require('./vue/common/BlockDate').default);
Vue.component('block-photo', require('./vue/common/BlockPhoto').default);
Vue.component('block-multi-photo', require('./vue/common/BlockMultiPhoto').default);

Vue.component('vue-chosen', require('./vue/VueChosen').default);
Vue.component('vue-slide-up-down', require('vue-slide-up-down').default);

Vue.component('form-search', require('./vue/FormSearch').default);
Vue.component('form-payment', require('./vue/FormPayment').default);
Vue.component('form-psychologist-data', require('./vue/FormPsychologistData').default);
Vue.component('form-user-data', require('./vue/FormUserData').default);
Vue.component('form-psychologist-register', require('./vue/FormPsychologistRegister').default);
Vue.component('form-user-schedule', require('./vue/FormUserSchedule').default);
Vue.component('form-psychologist-schedule', require('./vue/FormPsychologistSchedule').default);

Vue.component('form-support', require('./vue/FormSupport').default);

import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

Vue.component('calendar', Calendar)
Vue.component('date-picker', DatePicker)


new Vue({
    el: '#app',
})

Vue.config.devtools = true;

require('./script');
