<template>
    
    <div class="row">
      <div  class="col-md-6">
        <div class="form-group">
          <label>Customer</label>
          <type-helper
            :url="customerURL"
            :initialize="form.customer"
            @input="onCustomer"
          >
          </type-helper>
        </div>
        
      </div>
    </div>
    
</template>

<script>
import TypeHelper from './typeahead/TypeHelper.vue';
import { get,byMethod } from '../service/api.js'

export default {
  name: 'App',
  components: {
    // DinnerCalculator,
    TypeHelper
  },
  data(){
    return{
      form: {},
      customerURL: 'http://127.0.0.1:8000/admin/customers/search'
    }
  },
  methods:{
    onCustomer(e) {
        const customer = e.target.value
        this.$set(this.$data.form, 'customer', customer)
        this.$set(this.$data.form, 'customer_id', customer.id)
    },
  }
}
</script>

<style>
</style>
