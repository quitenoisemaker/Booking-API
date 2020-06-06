import VueRouter from 'vue-router';
import bookable from "./bookable/bookable.vue";
import bookables from "./bookables/bookables";
import review from "./review/review";


const routes = [

    {
        path: "/",
        component: bookables,
        name: "home",
    },

    {
        path: "/bookable/:id", //here we are telling vue it should have a parameter
        component: bookable,
        name: "bookable",
    },

    {
        path: "/review/:id", //here we are telling vue it should have a parameter
        component: review,
        name: "review",
    },
   
];


const router = new VueRouter({
 
    routes, // short for 'routes:routes'
    mode: 'history'
   });

   export default router;// exporting the router