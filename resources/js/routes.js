import VueRouter from 'vue-router';
import bookable from "./bookable/bookable.vue";
import bookables from "./bookables/bookables";


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
   
];


const router = new VueRouter({
 
    routes, // short for 'routes:routes'
    mode: 'history'
   });

   export default router;// exporting the router