import Vue from 'vue'
import VueRouter from 'vue-router'

import DashboardComponent from '../components/dashboard/DashboardComponent.vue';
import InvoiceIndex from '../components/invoices/InvoiceIndex.vue';
import InvoiceForm from '../components/invoices/InvoiceForm.vue';


Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        // {
        //     path:'*',
        //     redirect:'/dashboard',
        //     component:DashboardComponent
        // },
        {
            path:'/dashboard',
            component: DashboardComponent
        },
        {
            path:'/invoices',
            component: InvoiceIndex
        },
        {
            path:'/invoices/create',
            component: InvoiceForm
        }
        
    ],
    mode:'history'
});

router.beforeEach((to,from,next)=>{
    console.log('b4 each route');
    next();
});

export default router