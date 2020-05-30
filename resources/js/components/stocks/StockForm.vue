<template>
   <div class="tile">
     <div class="row pb-3 pt-5 bg-light">
        <div class="col-md-8">
            <div class="form-group">
                <label for="distributor">Select Distributor</label>
                  <Autocomplete
                     :items="allDistributors"
                     @selected="distributorSelected"
                     
                     filterby="company_name"
                     title="Type or click to select"
                  />
                  <small class="text-danger" v-if="errors.distributor_id">
                        {{errors.distributor_id[0]}}
                  </small>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="stock_date">Date</label>
                <input type="date" class="form-control" v-model="theDate">
                <!-- <datepicker></datepicker> -->
                <small class="text-danger" v-if="errors.date">
                            {{errors.date[0]}}
                        </small>
            </div>
            <div class="form-group">
                <label for="stock_number">Stock Number</label>
                <input type="text" class="form-control" v-model="form.reference" name="stock_number" placeholder="stock number">
                <small class="text-danger" v-if="errors.reference">
                  {{errors.reference[0]}}
                </small>
            </div>
        </div>
    </div>

      <!-- table -->
      <div class="row">
         <table class="table table-hover">
            <thead class="bg-light">
                  <tr>
                     <th style="width: 20px;">No.</th>
                     <th>Product Discription</th>
                     <th style="width: 130px">Price</th>
                     <th style="width: 90px;">Quantity</th>
                     <th style="width: 130px;">Unit Cost</th>   
                     <th style="width:100px; min-width:100px;" class="text-center text-danger" ><i class="fa fa-bolt"> </i></th>
                        
                  </tr>
            </thead>
            <tbody>
               <tr  v-for="(stock_item, index) in form.stock_items" :key="stock_item.data"> 
                  
                  <td>
                     {{index + 1}}
                  </td>
                  <!-- product description -->
                  <td>
                     <div class="form-group" @click="getIndex(index)">
                        <Autocomplete
                           :items="allProducts"
                           @selected="productSelected"
                           
                           filterby="text"
                           title="Type or click to select"
                        />
                        <small class="text-danger" v-if="errors[`stock_items.${index}.product_id`]">
                           {{errors[`stock_items.${index}.product_id`][0]}}
                        </small>
                     </div>
                  </td>
                  <!-- Price -->
                  <td>
                  <input type="text" class="form-control" v-model="stock_item.price"  readonly />
                  </td>    
                  <td>
                     <!-- Quantity -->
                     <div class="form-group">
                        <input type="number" min="1" class="form-control" v-model="stock_item.quantity">
                        <small class="text-danger" v-if="errors[`stock_items.${index}.quantity`]">
                           {{errors[`stock_items.${index}.qty`][0]}}
                        </small>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control"  v-model="stock_item.unit_price = stock_item.quantity * stock_item.price" readonly>
                        <small class="text-danger" v-if="errors[`stock_items.${index}.unit_price`]">
                           {{errors[`stock_items.${index}.unit_price`][0]}}
                        </small>
                     </div>
                  </td>
                  <td class="text-center">
                     <span style="font-size:20px"  
                        class="text-danger" @click="removestock_item(index)">
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
                  <label for="stock_total">Total</label>
                  <input type="text" class=" form-control" v-model="getTotal" readonly>
               </div>
               
               <hr />
               </div>
               <div class="pt-2">
                  <a  class="btn btn-primary text-white pull-left" @click="onSave">
                     <i class="fa fa-save"></i>
                     Save
                  </a>
               </div>
         </div>
      </div>
   </div>   
                         
      
    
</template>

<script>
import {mapState,mapActions,mapGetters} from 'vuex';
import moment from 'moment';
import Api from '../../service/api.js';
import Autocomplete from '../typeahead/Autocomplete.vue';
import { get,byMethod } from '../../service/api.js';
// import ErrorBag from '../../service/errorbag.js';


export default {
    name:"StockForm",
    components:{
       Autocomplete
    },
    data(){
        return{
            theDate: moment().format('YYYY-MM-DD'),
            index:0,
            form: {},
            errors:{},
            currentRoute:window.location.pathname
            // errors: new ErrorBag,
        }
    },
    computed:{
      ...mapGetters(['allCustomers','allProducts','allDistributors']),
      getTotal: function () {
         var sum = 0;
         this.form.stock_items.forEach(stock_item => {
            sum += stock_item.unit_price;
         });
         this.form.total = parseFloat(sum.toFixed(2));

         return parseFloat(sum.toFixed(2))
      },
    },
    created(){
    
       this.fetchProducts();
       this.loadStockForm();
       this.fetchDistributors();
       console.log('total');
       console.log(this.getTotal);
    },
    watch:{
       index:function(){
          console.log(this.index);
       },
    },
    methods:{
      ...mapActions(['fetchCustomers','fetchProducts','fetchDistributors','createStock']),

      async loadStockForm(){
        let response = await Api().get('/stocks/loadstockform');
        console.log(response.data.form);
        this.$set(this.$data,'form',response.data.form);
      },
     
      addNewLine() {
         this.form.stock_items.push({
            product_id: null,
            product: null,
            unit_price: 0,
            quantity: 1
         })
      },
      removestock_item(index) {
         this.form.stock_items.splice(index, 1)
      },
       getIndex(index){
         this.index = index
      },
       
      productSelected(product){
         Vue.set(this.form.stock_items[this.index], 'product_id',product.id, 
                   Vue.set(this.form.stock_items[this.index], 'product', product))

         Vue.set(this.form.stock_items[this.index], 'price', parseFloat(product.stock_price))
      },
      distributorSelected(distributor){
         this.$set(this.$data.form,'distributor',distributor);
         this.$set(this.form,'distributor_id',distributor.id);
      },
      // async onSave() {
      //       this.errors = {};
      //       await Api().post('/stocks/store',this.form)
      //       .then((response)=>{
               
      //          window.location = Api().get('/stocks/'+response.data.id+'/show');
               
      //       })
      //       .catch((error) => {
      //             if(error.response.status === 422) {
      //                   this.errors = error.response.data.errors
      //             }
      //          })
      // }
      async onSave(){
         try {
            this.errors = {}
            // await Api().post('/stocks/store',this.form)
            const response = await Api().post('/stocks/store',this.form)
            window.location.href = `${response.data.id}/show`;
         } catch (error) {
            if(error.response.status === 422) {
               this.errors = error.response.data.errors
           }
         }
      }
   }
}
</script>

<style>

</style>