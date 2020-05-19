<template>
   <div class="tile">
            <div class="tile-body">
                <div class="row pb-3 pt-5 bg-light">
                    <div class="col-md-8">
                        <div class="form-group">
                           <h3>Emmandget 19 Enterprise</h3>
                           <p><span>&nbsp;P.O.Box ks 12480 <br></span>
                            <span>&nbsp;Adum - Kumasi <br></span>
                           <span>&nbsp;Telephone : 0244547665<br></span>
                           <span>&nbsp;Mail : emmaagyeidarko@gmail.com</span>
                           </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                       <div class="form-group">
                            <label for="stock_date">Date</label>
                            <!-- <datepicker></datepicker> -->
                            
                        </div>
                        <div class="form-group">
                            <label for="stock_invoice">Select Customer</label>
                            <input type="text" class="form-control" name="stock_invoice_number" placeholder="Customer Info">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 20px;">No.</th>
                                <th>Name of Products</th>
                                <th style="width: 90px;">Quantity</th>
                                <th style="width: 130px;" class="text-right">Price</th>
                                <th style="width: 130px;">Unit Cost</th>   
                                <th style="width:100px; min-width:100px;" class="text-center text-danger" ><i class="fa fa-bolt"> </i></th>
                                    
                            </tr>
                        </thead>
                        <tbody >
                            <tr v-for="(item,index) in items" :key="index">
                            <td class="align-middle py-0">
                                {{ index + 1 }}
                            </td>
                            <td>
                                <input class="form-control" 
                                    autocomplete="off"
                                    name="name"
                                    type="text" 
                                    v-model="item.name"
                                    @keydown.tab.prevent="complete()"
                                    @keyup="onInputChange($event,index)"
                                    @keydown="onSelectData"
                                />
                                <table class="tile"
                                    v-show="filteredData.length">
                                    <tbody>
                                        <tr v-for="(product, i) in filteredData"
                                        :key="product.id"
                                        @click="complete(i,index)">
                                        <td :class="{active: searchIndex === i}">{{ product[field] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <input class="form-control"
                                        name="quantity" 
                                        v-model="item.quantity"
                                        type="number" 
                                        min="0"
                                />
                            </td>
                            <td>
                                <input class="form-control" 
                                        name="price" 
                                        type="number"
                                        min="0"
                                        v-model="item.price"
                                         readonly 
                                />
                            </td>
                           
                            <td>
                                <input class="form-control text-right"
                                    name="unitcost" 
                                    v-model="item.quantity * item.price"
                                    number readonly 
                                />
                            </td>
                            <td class="text-center">
                                <span style="font-size:20px"  
                                    class="text-danger" v-on:click="deleteItem(index)">
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
                                @click="addNewItem"
                        >

                            <i class="fa fa-plus"> </i>
                            Add New Product
                        </button>
                    </div>
                  </div>
                  <div class="col-md-4 offset-md-5">
                      <div class="pt-2">
                        <hr />
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
                         
        </div>
    
</template>

<script>

const ARROW_DOWN_KEYCODE = 40;
const ARROW_UP_KEYCODE= 38;
const ENTER_KEYCODE = 13;
const TAB_KEYCODE = 9;

import Typeahead from '../typeahead/Typeahead.vue';

export default {

    name:"InvoiceItem",
    props:{
        allProducts:Array,
        field:String
    },
    data(){
        return{
            filteredData: [],
            searchIndex: 0,

            items: [
                { name: '', quantity: 0, price: 0 },
            ],
        }
    },
    methods:{
        addNewItem: function() {
            this.items.push(
                { name: '', quantity: 0, price: 0 }
            )
        },
        deleteItem: function(index) {
            this.items.splice(index, 1)
        },
         onInputChange(e,index){
            const isEnterKey = e.keyCode === ENTER_KEYCODE;
            const isArrowDownKey = e.keyCode === ARROW_DOWN_KEYCODE;
            const isArrowUpKey = e.keyCode === ARROW_UP_KEYCODE;
            const isTabKey = e.keyCode === TAB_KEYCODE;

            if(isEnterKey || isArrowDownKey || isArrowUpKey || isTabKey) {
                return;
            }

            const search = e.target.value.toLowerCase();
            this.items[index].name = e.target.value;
            // this.searchIndex = 0;

            if(this.items[index].name.length) {
                this.filteredData = 
                        this.allProducts.filter((product) => 
                            product[this.field].toLowerCase()
                                .startsWith(search)); 
            }else {
                this.filteredData = [];
            }

        },
        onSelectData(e) {
            const isArrowDownKey = e.keyCode === ARROW_DOWN_KEYCODE;
            const isArrowUpKey = e.keyCode === ARROW_UP_KEYCODE;
            const isEnterKey = e.keyCode === ENTER_KEYCODE;

            if(isArrowDownKey && this.searchIndex < this.filteredData.length - 1) {
                this.searchIndex++;
            }else if(isArrowUpKey && this.searchIndex > 0) {
                this.searchIndex--;
            }else if(isEnterKey) {
                this.complete(this.searchIndex);
                
            } 
        },
        complete(i,index) {
            this.items[index].name = this.filteredData[i][this.field];
            this.items[index].price = this.filteredData[i].sales_price_per_carton;
           
           
            this.filteredData = [];
        },
       
    }
}
</script>

<style>

</style>