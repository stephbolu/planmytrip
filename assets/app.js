import Vue from 'vue';
import App from './App.vue';

require('./css/app.css');
require('./css/main.css');
require('./css/font-awesome.min.css');


new Vue({
    template: '<App/>',
    components: { App },
}).$mount('#app');