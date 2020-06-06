

require('./bootstrap');
import router from './routes';
import VueRouter from 'vue-router';
import index from './index';
import moment from "moment"; // importing the moment library
import starRating from "./shared/components/starRating";
import fatalError from "./shared/components/fatalError";

window.Vue = require('vue');




// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example-2', require('./components/Example2.vue').default);

Vue.use(VueRouter);

Vue.filter("fromNow", value => moment(value).fromNow());


Vue.component("star-rating", starRating);

Vue.component("fatal-error", fatalError);

const app = new Vue({
    el: '#app',
    router: router,
    components: {
        "index": index
    }
});
