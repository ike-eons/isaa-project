<template>
  <div class="tile">
    <div class="row">
      <div class="col-md-12">
        <p class="mb-3 line-head">Create Invoice {{duedate()}}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="customer">Customer</label>
          <Autocomplete
            :items="allCustomers"
            @selected="customerSelected"
            filterby="text"
            title="Type or click to select"
          />
          <small class="text-danger" v-if="errors.customer_id">
            {{errors.customer_id[0]}}
          </small>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="number" class>
            <span class="pr-4">Number</span>
            <small class="pl-5">Auto Generated</small>
          </label>
          <span class="form-control">{{form.number}}</span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="reference">
            <span class="pr-5">Reference</span>
            <small class="pl-5">Optional</small>
          </label>
          <span class="form-control">{{form.reference}}</span>
        </div>
      </div>
    </div>

    <!-- dates -->
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" v-model="date" class="form-control" />
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="date">Due Date</label>
          <input type="date" v-model="form.due_date" class="form-control" />
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
            <th style="width: 130px;">Price</th>
            <th style="width: 90px;">Quantity</th>
            <th style="width: 130px;">Unit Cost</th>
            <th style="width:100px; min-width:100px;" class="text-center text-danger">
              <i class="fa fa-bolt"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(invoice_item, index) in form.invoice_items" :key="invoice_item.index">
            <td>{{index + 1}}</td>
            <td>
              <div class="form-group" @click="getIndex(index)">
                <Autocomplete
                  :items="allProducts"
                  @selected="productSelected"
                  
                  filterby="text"
                  title="Type or click to select"
                />
                <small
                  class="text-danger"
                  v-if="errors[`invoice_items.${index}.product_id`]"
                >{{errors[`invoice_items.${index}.product_id`][0]}}</small>
              </div>
            </td>
            <!-- Price -->
            <td>
              <input type="text" class="form-control" v-model="invoice_item.price"  readonly />
              <small class="error-control"
                  v-if="errors[`invoice_items.${index}.quantity`]">{{errors[`invoice_items.${index}.quantity`][0]}}
              </small>
            </td>
            <td>
              <!-- Quantity -->
              <div class="form-group">
                <input type="number" min="1" class="form-control" v-model="invoice_item.quantity" />
                <small
                  class="error-control"
                  v-if="errors[`invoice_items.${index}.quantity`]"
                >{{errors[`invoice_items.${index}.quantity`][0]}}</small>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="text" class="form-control" name="unit_price" :value="invoice_item.unit_price=cal_unit_price(invoice_item.quantity , invoice_item.price)" readonly />
                <small
                  class="text-danger"
                  v-if="errors[`invoice_items.${index}.unit_price`]">{{errors[`invoice_items.${index}.unit_price`][0]}}</small>
              </div>
            </td>
            <td class="text-center">
              <span style="font-size:20px" class="text-danger" @click="removeItem(index)">
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
          <button class="btn btn-info btn-sm pull-left" @click="addNewLine">
            <i class="fa fa-plus"></i>
            Add New Product
          </button>
        </div>
      </div>
      <div class="col-md-4 offset-md-5">
        <div class="pt-2">
          <hr />

          <label for="invoice_total">Total</label>
          <input type="text" class=" form-control" :value="totalAmount()" readonly>
          <hr />
        </div>
        <div class="pt-2">
          <button class="btn btn-primary pull-left" @click="onSave">
              <i class="fa fa-save"></i>
              Save
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import moment from 'moment';
import Api from "../../service/api.js";
import Autocomplete from "../typeahead/Autocomplete.vue";

export default {
  name: "InvoiceItem",
  components: {
    Autocomplete
  },
  data() {
    return {
      index:0,
      customers: [],
      form: {},
      errors: {},
      date: moment().format("YYYY-MM-DD"),
      due_date: moment().format("YYYY-MM-DD")
    
    };
  },
  computed: {
    ...mapGetters(["allCustomers", "allProducts"]),
    // totalAmount: function () {
    //     var sum = 0;
    //      this.form.invoice_items.forEach(invoice_item => {
    //         sum += invoice_item.unit_price;
    //      });
    //     this.form.total = parseFloat(sum.toFixed(2));
    //     return sum.toFixed(2)
    // },

  },
  created() {
    this.fetchCustomers();
    this.fetchProducts();
    this.loadInvoiceForm();
    this.duedate();
  },
  mounted:{
  },
  watch:{
    index:function(){
      console.log(this.index)
    },
  },
  methods: {
    ...mapActions(["fetchCustomers", "fetchProducts"]),
    async loadInvoiceForm() {
      let response = await Api().get("/invoices/loadinvoiceform");
      this.$set(this.$data, "form", response.data.form);
    },
    cal_unit_price(price=0,quantity=0){
        let unit_price = price * quantity;
        return unit_price.toFixed(2);
    },
    totalAmount () {
        var sum = 0;
         this.form.invoice_items.forEach(invoice_item => {
            sum += parseFloat(invoice_item.unit_price);
         });
        this.form.total = parseFloat(sum.toFixed(2));
        return sum.toFixed(2)
    },
    getIndex(index){
      this.index = index
    },
    duedate(){
      // var currentDate = new Date();
      // var newDate = currentDate.addDays(7);
      // console.log(newDate);     
      
      const today = moment();
      const nextWeek = today.add(7, 'days');
      const nextWeekFormat = nextWeek.format('YYYY-MM-DD');
      this.$set(this.form,'due_date',nextWeekFormat);
      // return nextWeek.format('YYYY-MM-DD');
    },
    addNewLine() {
      this.form.invoice_items.push({
          product_id: null,
          product: null,
          unit_price: 0,
          qty: 1
      })
    },
    removeItem(index) {
      this.form.invoice_items.splice(index, 1);
    },
    customerSelected(customer) {
      this.$set(this.$data.form,'customer',customer);
      this.$set(this.form,'customer_id',customer.id);
    },
    productSelected(product){
        Vue.set(this.form.invoice_items[this.index], 'product_id',product.id, 
                  Vue.set(this.form.invoice_items[this.index], 'product', product))

        Vue.set(this.form.invoice_items[this.index], 'price', parseFloat(product.sales_price))
        
    },
    addNewLine() {
      this.form.invoice_items.push({
          product_id: null,
          product: null,
          price:0,
          unit_price: 0,
          quantity: 1
      })
    },
  //   async onSave() {
  //     this.errors = {};
  //           await Api().post('/invoices/store',this.form)
  //           .then(
  //              // window.location.href = Api().get('/stocks/')
  //           )
  //           .catch((error) => {
  //                 if(error.response.status === 422) {
  //                       this.errors = error.response.data.errors
  //                 }
  //              });
  //   }
  // },
   async onSave(){
         try {
            this.errors = {}
            // await Api().post('/invoices/store',this.form)
            const response = await Api().post('/invoices/store',this.form)
            window.location.href = `${response.data.id}/show`;
         } catch (error) {
            if(error.response.status === 422) {
               this.errors = error.response.data.errors
           }
         }
      }
   }
};
</script>

<style>
</style>