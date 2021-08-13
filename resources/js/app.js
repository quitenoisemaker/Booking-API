

require('./bootstrap');
import router from './routes';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import index from './index';
import moment from "moment"; // importing the moment library
import starRating from "./shared/components/starRating";
import fatalError from "./shared/components/fatalError";
import success from "./shared/components/success";
import validationErrors from "./shared/components/validationErrors";
import storeDefinition from "./store";

window.Vue = require('vue');




// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example-2', require('./components/Example2.vue').default);

Vue.use(VueRouter);
Vue.use(Vuex)


Vue.filter("fromNow", value => moment(value).fromNow());


Vue.component("star-rating", starRating);

Vue.component("fatal-error", fatalError);
Vue.component("success", success);
Vue.component("v-errors", validationErrors);

//creating the Vuex Store
const store =new Vuex.Store(storeDefinition);
//end



const app = new Vue({
    el: '#app',
    router: router,
    store,
    components: {
        "index": index
    },
    beforeCreate() {
        this.$store.dispatch("loadStoredState");
    },
});
