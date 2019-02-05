import Vue from 'vue';
import App from './App';

require('../css/app.css');

new Vue({
    template: '<App/>',
    components: { App },
}).$mount('#app');