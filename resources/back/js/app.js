try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('@popperjs/core')
    require('bootstrap');
} catch (e) {}

require('./functions');


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//vue
import Vue from 'vue'

import { ZiggyVue } from 'ziggy';
import { Ziggy } from '../../js/ziggy';

Vue.use(ZiggyVue, Ziggy);

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers['Content-Type'] = 'application/json';

Vue.component('pagination', require('./vue/common/Pagination').default);
Vue.component('pages-index', require('./vue/PagesIndex').default);

new Vue({
    el: '#app',
})

Vue.config.devtools = true;

require('./script');
