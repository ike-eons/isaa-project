<template>
        <div class="tile">
            <div class="tile-body">
                <div class="row pb-3 pt-5 bg-light">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="distributor">Select Distributor</label>
                                <select class="form-control" id="distributor">
                                <option>M OSEI AKOTO ENT(NESTLE)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                       <div class="form-group">
                            <label for="stock_date">Date</label>
                            <!-- <datepicker></datepicker> -->
                            
                        </div>
                        <div class="form-group">
                            <label for="stock_invoice">Stock Number</label>
                            <input type="text" class="form-control" name="stock_invoice_number" placeholder="stock invoice number">
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
                                <th style="width: 80px;">Per</th>
                                <th style="width: 130px;">Unit Cost</th>   
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                                    
                            </tr>
                        </thead>
                        <tbody >
                            <tr v-for="(row,index) in rows" :key="index">
                            <td class="align-middle py-0">
                                {{ index +1 }}
                            </td>
                            <td>
                                <input class="form-control" 
                                    v-model="row.name" 
                                    name="name" 
                                    type="text"
                                    @keydown.tab.prevent="complete()"
                                    @keyup="onInputChange"
                                    @keydown="onSelectData"
                                />
                                <table class="tile"
                                    v-show="filteredData.length">
                                    <tbody>
                                        <tr v-for="(product, i) in filteredData"
                                        :key="product.id"
                                        @click="complete(i)">
                                        <td :class="{active: searchIndex === i}">{{ product[field] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <input class="form-control" v-model="row.quantity" name="quantity" type="number" />
                            </td>
                            <td>
                                <input class="form-control" v-model="row.price" name="price" type="number" readonly />
                            </td>
                            <td>
                                <input class="form-control text-right" value="ctns"  number readonly />
                            </td>
                            <td>
                                <input class="form-control text-right" name="unitcost" 
                                        v-model="row.unitcost = row.quantity * row.price"
                                        number readonly 
                                />
                            </td>
                            <td class="text-center">
                                <span style="font-size:20px" @click="removeRow()" class="text-danger"><i class="fa fa-trash"></i></span>
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
                        <button  @click="addNewRow()" class="btn btn-info btn-sm pull-left">
                            <i class="fa fa-plus"> </i>
                            Add New Product
                        </button>
                    </div>
                  </div>
                  <div class="col-md-4 offset-md-5">
                      <div class="pt-2">
                        <hr />
                        <p class="text-bold">Total: {{getTotal}}</p>
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

// import moment from 'moment';
// import Datepicker from 'vuejs-datepicker';

const ARROW_DOWN_KEYCODE = 40;
const ARROW_UP_KEYCODE= 38;
const ENTER_KEYCODE = 13;
const TAB_KEYCODE = 9;


export default {
    name:'AddStocks',
    props:{
        allProducts:Array,
        field: String
    },
    components: {
        // Datepicker
    },
    data(){
        return{
            dateFormat: "YYYY/MM/DD",
            filteredData: [],
            searchIndex: 0,
            rows:[
                { 
                name: "",
                quantity: 0, 
                price: 0.00,
                per:'ctn',
                unitcost:0.00
                }
            ],
            total: 0,
        }
    },
    computed:{
        getTotal(){
            let total = 0;
            for(var i in this.rows){
                total += this.rows[i].unitcost;
               
            }
            return total;
        },
        getUnitCost(){
            this.unitcost = this.price * this.quantity;
            return this.unitcost;
        }
    },
   
    methods:{
        
        addNewRow: function (index) {
           this.rows.push(
                { name: '', quantity: 0, price: 0,per:'ctns',unitcost:0.00}
            )
        },
        removeRow: function (index) {
            this.rows.splice(index, 1);
        },
        onInputChange(e){
            const isEnterKey = e.keyCode === ENTER_KEYCODE;
            const isArrowDownKey = e.keyCode === ARROW_DOWN_KEYCODE;
            const isArrowUpKey = e.keyCode === ARROW_UP_KEYCODE;
            const isTabKey = e.keyCode === TAB_KEYCODE;

            if(isEnterKey || isArrowDownKey || isArrowUpKey || isTabKey) {
                return;
            }

            const search = e.target.value.toLowerCase();
            this.rows[this.searchIndex].name = e.target.value;
            // this.searchIndex = 0;

            if(this.rows[this.searchIndex].name.length) {
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
        complete(i) {
            this.rows[this.searchIndex].name = this.filteredData[i][this.field];
            this.rows[this.searchIndex].price = this.filteredData[i].sales_price_per_carton;
            this.rows[this.searchIndex].unitcost =   ((this.filteredData[i].sales_price_per_carton) * this.rows[this.searchIndex].qty);
           
            this.filteredData = [];
        },
         display(){
          
          for(var key in this.allProducts)
          {
              var obj = this.allProducts[key];
            //   console.log('show  '+obj['name']);
              console.log(this.allProducts[key].name+' '+this.allProducts[key].sales_price_per_carton)
          }
        console.log(5)
           
        },
        create(){
            this.display();
        }
       
    },
    created(){
        // this.getUnitCost;
    }
    
}
</script>

<style scoped>
   
</style>