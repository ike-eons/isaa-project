<template>
   <div class="tile">
      <div class="row">
         <div class="col-md-12">
            <p class="mb-3 line-head">Create Invoice</p>
         </div>
      </div>
       <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label for="customer">Customer</label>
               <Autocomplete :items="allCustomers"
                  filterby="text"
                  
                  title="Type or click to select"
                  
               />
               
            </div>
         </div>
         <div class="col-md-3">      
            <div class="form-group">
               <label for="number" class="">
                  <span class="pr-4">Number</span>
                  <small class="pl-5">Auto Generated</small>
               </label> 
               <span class="form-control">INV-10000</span>
               
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label for="reference">
                  <span class="pr-5">Reference</span>
                  <small class="pl-5">Optional</small>
               </label>
               <span class="form-control">#EMJ19-2020</span>
            </div>
         </div>
      </div>

      <!-- dates -->
      <div class="row">
         <div class="col-md-3">
            <div class="form-group">
               <label for="date">Date</label>
               <input type="date" class="form-control" />
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label for="date">Due Date</label>
               <input type="date" class="form-control" />
            </div>
         </div>
      </div>

      <!-- table -->
       <!-- table -->
      <div class="row">
         <table class="table table-hover">
            <thead class="bg-light">
                  <tr>
                     <th style="width: 20px;">No.</th>
                     <th>Product Discription</th>
                     <th style="width: 90px;">Quantity</th>
                     <th style="width: 130px;">Unit Cost</th>   
                     <th style="width:100px; min-width:100px;" class="text-center text-danger" ><i class="fa fa-bolt"> </i></th>
                        
                  </tr>
            </thead>
            <tbody>
               <tr  v-for="(item, index) in form.items" :key="item.data"> 
                  
                  <td>
                     {{index + 1}}
                  </td>
                  <!-- product description -->
                  <td>
                     <div class="form-group">
                        
                        <small class="text-danger" v-if="errors[`items.${index}.product_id`]">
                           {{errors[`items.${index}.product_id`][0]}}
                        </small>
                     </div>
                  </td>
                  <td>
                     <!-- Quantity -->
                     <div class="form-group">
                        <input type="number" min="1" class="form-control" v-model="item.quantity">
                        <small class="error-control" v-if="errors[`items.${index}.quantity`]">
                           {{errors[`items.${index}.qty`][0]}}
                        </small>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control" v-model="item.unit_price" readonly>
                        <small class="text-danger" v-if="errors[`items.${index}.unit_price`]">
                           {{errors[`items.${index}.unit_price`][0]}}
                        </small>
                     </div>
                  </td>
                  <td class="text-center">
                     <span style="font-size:20px"  
                        class="text-danger" @click="removeItem(index)">
                        <i class="fa fa-trash"></i>
                     </span>
                  </td>
               </tr>
            </tbody>
            
         </table>
      </div> 
      <div class="pt-1">
         <hr />
      </div>
      <div class="row">
         <div class="col-3">
            <div class="pt-2">
               <button  class="btn btn-info btn-sm pull-left"
                  @click="addNewLine"
               >
                  <i class="fa fa-plus"> </i>
                  Add New Product
               </button>
            </div>
         </div>
         <div class="col-md-4 offset-md-5">
               <div class="pt-2">
               <hr />
               <div class="form-group">
                     <input type="number" class="form-control">
                     <small class="form-control" v-if="errors.discount">
                        <!-- {{errors.discount[0]}} -->
                     </small>
               </div>
               
               <p class="text-bold">Total: </p>
               <hr />
               </div>
               <div class="pt-2">
                  <a href="#" class="btn btn-primary pull-left">
                     <i class="fa fa-save"></i>
                     Save
                  </a>
               </div>
         </div>
      </div>
   </div>  
                         
      
    
</template>

<script>
import {mapState,mapActions,mapGetters, mapMutations} from 'vuex';
import Api from '../../service/api.js';
import Autocomplete from '../typeahead/Autocomplete.vue';

export default {
    name:"InvoiceItem",
    components:{
      Autocomplete
    },
     mounted(){
       this.fetchCustomers();
       this.customers = this.allCustomers;
      //  this.getCustomerName();
    },
    data(){
        return{
           customers: [],
            form: {},
            errors: {},
        }
    },
    computed:{
      ...mapGetters(['allCustomers']),
    },
    methods:{
      ...mapActions(['fetchCustomers']),
      ...mapMutations(['setCustomers']),
      async loadCustomers(){
         let response = await Api().get('/customers/loadcustomers');
         console.log(response.data.customers);
      },
      addNewLine() {
         this.form.items.push({
            product_id: null,
            product: null,
            unit_price: 0,
            quantity: 1
         })
      },
      removeItem(index) {
         this.form.items.splice(index, 1)
      },
      
    },
   
}
</script>

<style>

</style>