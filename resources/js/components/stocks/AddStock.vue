<template>
  <div>
      <auto-complete
        :allProducts="allProducts"
        :field="field"
      >
      </auto-complete>

       <div>
            <ul v-for="(product,index) in allProducts" :key="product.id"> 
                <li>{{product.name}} {{index}}</li>
            </ul>
        </div>
  </div> 
</template>

<script>

import { mapActions,mapGetters,mapMutations } from "vuex";
import AutoComplete from './AutoComplete.vue';

export default {
    name:"AddStock",
    components:{
        AutoComplete,
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