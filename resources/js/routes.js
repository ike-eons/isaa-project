
import CustomerComponent from './components/customers/CustomerComponent.vue'
import ProductComponent from './components/products/ProductComponent.vue'
import ExampleComponent from './components/ExampleComponent.vue'



export const routes = [
    {
        path:'/customers',
        component: CustomerComponent
    },
    {
        path:'/products',
        name:'product-component',
        component: ProductComponent
    },
    {
        path:'/example',
        component: ExampleComponent
    },
]