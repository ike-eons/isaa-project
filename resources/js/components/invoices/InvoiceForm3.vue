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
          <Autocomplete
            :items="allCustomers"
            @selected="customerSelected"
            filterby="text"
            title="Type or click to select"
          />
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="number" class>
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
    <div class="row">
      <table class="table table-hover">
        <thead class="bg-light">
          <tr>
            <th style="width: 20px;">No.</th>
            <th>Product Discription</th>
            <th>Price</th>
            <th style="width: 90px;">Quantity</th>
            <th style="width: 130px;">Unit Cost</th>
            <th style="width:100px; min-width:100px;" class="text-center text-danger">
              <i class="fa fa-bolt"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in form.items" :key="item.index">
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
                  v-if="errors[`items.${index}.product_id`]"
                >{{errors[`items.${index}.product_id`][0]}}</small>
              </div>
            </td>
            <!-- Price -->
            <td>
              <input type="text" class="form-control" v-model="item.price"  readonly />
            </td>
            <td>
              <!-- Quantity -->
              <div class="form-group">
                <input type="number" min="1" class="form-control" v-model="item.quantity" />
                <small
                  class="error-control"
                  v-if="errors[`items.${index}.quantity`]"
                >{{errors[`items.${index}.quantity`][0]}}</small>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="text" class="form-control" v-model="item.price * item.quantity" readonly />
                <small
                  class="text-danger"
                  v-if="errors[`items.${index}.unit_price`]"
                >{{errors[`items.${index}.unit_price`][0]}}</small>
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
          <div class="form-group">
            <input type="number" class="form-control" />
            <small class="form-control" v-if="errors.discount">
              <!-- {{errors.discount[0]}} -->
            </small>
          </div>

          <p class="text-bold">Total:</p>
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
import { mapState, mapActions, mapGetters } from "vuex";
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
      // currentProduct: {},
      // currentItem: {},
      // invoiceItems: [],
      // tempItem: { product_id: null, unit_price: 0, quantity: 1 }
    };
  },
  computed: {
    ...mapGetters(["allCustomers", "allProducts"]),

  },
  created() {
    this.fetchCustomers();
    this.fetchProducts();
    this.loadInvoiceForm();
  },
  watch:{
    index:function(){
      console.log(this.index)
    }
  },
  methods: {
    ...mapActions(["fetchCustomers", "fetchProducts"]),
    async loadInvoiceForm() {
      let response = await Api().get("/invoices/loadinvoiceform");
      // console.log(response.data.form);
      this.$set(this.$data, "form", response.data.form);
    },
    getIndex(index){
      this.index = index
    },
    addNewLine() {
      this.form.items.push({
          product_id: null,
          product: null,
          unit_price: 0,
          qty: 1
      })
    },
    removeItem(index) {
      this.form.items.splice(index, 1);
    },
    customerSelected(customer) {
      console.log(
        `Customer Selected:\nid: ${customer.id}\nname: ${customer.text}`
      );
    },
    productSelected(product){
      
      console.log( `Product Selected:\nid: ${this.index}\nname: ${product.text}`);
      Vue.set(this.form.items[this.index], 'product_id',  Vue.set(this.form.items[this.index], 'product', product))

      Vue.set(this.form.items[this.index], 'price', product.price)
    },
    onProduct(index,e){
      const product = e.target.value;
      console.log("this product"+product);
    },
    addNewLine() {
      this.form.items.push({
          product_id: null,
          product: null,
          price:0,
          unit_price: 0,
          qty: 1
      })
    }
    // addNewLine() {
    //   this.currentItem = this.tempItem;
    //   this.form.items.push(this.tempItem);
    //   this.invoiceItems.push(this.tempItem);
    // },
    // productSelected(product) {
    //   this.currentProduct = product;
    //   let tempProductObj = this.findProduct(product.id);
    //   this.currentItem = tempProductObj.prod;
    //   console.log(tempProductObj);
    //   // console.log(this.form.items);
    //   let index = tempProductObj.index;
    //   if (!this.currentItem || !this.currentItem.product_id) {
    //     if (this.invoiceItems.length < 2) this.invoiceItems = [];
    //     this.currentItem = this.form.items[this.form.items.length - 1] || {};
    //     this.currentItem["product_id"] = product.id;
    //     (this.currentItem["unit_price"] = parseInt(product.price)),
    //       (this.currentItem["quantity"] = 1);
    //     this.invoiceItems.push(this.currentItem);
    //     index = this.form.items.length - 1;
    //   }

    //   Vue.set(
    //     this.form.items[index],
    //     "item",
    //     this.currentItem
    //   );

    //   // console.log(this.invoiceItems);
    // },

    // findProduct(id) {
    //   let index = null;
    //   let found = null;
    //   console.log(this.invoiceItems);
    //   this.form.items.forEach((item, ind) => {
    //     if (parseInt(item.product_id) == parseInt(id)) {
    //       // console.log("Item found")
    //       found = item;
    //       index = ind;
    //     }
    //   });

    //   return { index: index, prod: found };
    // },

    // priceChange(item, index) {
    //   // console.log(this.currentItem)

    //   this.currentItem.quantity = item.quantity;
    //   this.currentItem.unit_price =
    //     this.currentItem.quantity * parseInt(this.currentProduct.price);
    //   // this.currentItem.unit_price = item.unit_price
    //   this.invoiceItems[index] = this.currentItem;
    //   // console.log(this.currentItem);
    //   return this.invoiceItems[index].unit_price;
    // },

    // onCustomer(e) {
    //   const customer = e.target.value;
    //   // this.$set(this.$data,'customer',customer);
    //   this.$set(this.$data.form, "customer_id", customer.id);
    // }
  }
};
</script>

<style>
</style>