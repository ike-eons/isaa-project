<template>
   <div>
       <invoice-item
        :allProducts="allProducts"
        :field="field"
       >
       </invoice-item>
   </div>
</template>

<script>

import InvoiceItem from "./InvoiceItem.vue";
import { mapActions,mapGetters,mapMutations } from "vuex";

export default {

    name:'CreateInvoice',

    components:{
        InvoiceItem
    },
    data(){
        return{
            field:'name'
        }
    },
     computed:{
        ...mapGetters(['allProducts'])
    },
    methods:{
        ...mapActions(['fetchProducts']),
        ...mapMutations(['SET_PRODUCT']),

       
    },
     created(){
         this.fetchProducts();
         this.allProducts;
    }
}
</script>

<style>

</style>