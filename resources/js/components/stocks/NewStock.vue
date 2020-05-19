<template>
  <div class="panel" v-if="show">
        <div class="panel-heading">
            <span class="panel-title">Add Stock</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Customer</label>
                        <typeahead :url="customerURL" :initialize="form.customer"
                            @input="onCustomer" />
                        <small class="error-control" v-if="errors.customer_id">
                            {{errors.customer_id[0]}}
                        </small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>
                            Number
                            <small>Auto Generated</small>
                        </label>
                        <span class="form-control">{{form.number}}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>
                            Reference
                            <small>Optional</small>
                        </label>
                        <input type="text" class="form-control" v-model="form.reference">
                        <small class="error-control" v-if="errors.reference">
                            {{errors.reference[0]}}
                        </small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" v-model="form.date">
                        <small class="error-control" v-if="errors.date">
                            {{errors.date[0]}}
                        </small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" class="form-control" v-model="form.due_date">
                        <small class="error-control" v-if="errors.due_date">
                            {{errors.due_date[0]}}
                        </small>
                    </div>
                </div>
            </div>
            <hr>
            <table class="form-table">
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in form.items" :key="item.data" @click="detailsPage(item)">
                        <td class="w-14">
                            <typeahead :url="productURL" :initialize="item.product"
                                @input="onProduct(index, $event)" />
                            <small class="error-control" v-if="errors[`items.${index}.product_id`]">
                                {{errors[`items.${index}.product_id`][0]}}
                            </small>
                        </td>
                        <td class="w-4">
                            <input type="text" class="form-control" v-model="item.unit_price">
                            <small class="error-control" v-if="errors[`items.${index}.unit_price`]">
                                {{errors[`items.${index}.unit_price`][0]}}
                            </small>
                        </td>
                        <td class="w-2">
                            <input type="text" class="form-control" v-model="item.qty">
                            <small class="error-control" v-if="errors[`items.${index}.qty`]">
                                {{errors[`items.${index}.qty`][0]}}
                            </small>
                        </td>
                        <td class="w-4">
                            <span class="form-control">
                                {{Number(item.qty) * Number(item.unit_price) | formatMoney}}
                            </span>
                        </td>
                        <td>
                            <span class="form-remove" @click="removeItem(index)">&times;</span>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-sm"
                             @click="addNewLine">Add New Line</button>
                        </td>
                        <td class="form-summary">Sub Total</td>
                        <td>{{subTotal | formatMoney}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="form-summary">Discount</td>
                        <td>
                            <input type="text" class="form-control" v-model="form.discount">
                            <small class="form-control" v-if="errors.discount">
                                {{errors.discount[0]}}
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="form-summary">Grand Total</td>
                        <td>{{total | formatMoney}}</td>
                    </tr>
                </tfoot>
            </table>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Terms and Conditions</label>
                        <textarea class="form-control" v-model="form.terms_and_conditions"></textarea>
                        <small class="error-control" v-if="errors.terms_and_conditions">
                            {{errors.terms_and_conditions[0]}}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer flex-end">
            <div>
                <button class="btn btn-primary" :disabled="isProcessing" @click="onSave">Save</button>
                <button class="btn" :disabled="isProcessing" @click="onCancel">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>

import { get,byMethod } from '../../service/api'
import Vue from 'vue'
import Typeahead from '../typeahead/Typeahead.vue'

 function initialize(to) {
        let urls = {
            'create': `http://127.0.0.1:8000/admin/stocks/create`,
            'edit': `http://127.0.0.1:8000/admin/stocks/${to.params.id}/edit`
        }

        return (urls[to.meta.mode] || urls['create'])
    }

export default {
    components:{
      Typeahead,
    },
    data () {
      return {
          form: {},
          errors: {},
          isProcessing: false,
          show: false,
          resource: '/stocks',
          store: '/admins/stocks',
          method: 'POST',
          title: 'Create',
          productURL: '/admin/products',
          customerURL: '/admin/customers'
      }
  },
   beforeRouteEnter(to, from, next) {
            get(initialize(to))
                .then((res) => {
                    next(vm => vm.setData(res))
                })
        },
        beforeRouteUpdate(to, from, next) {
            this.show = false
            get(initialize(to))
                .then((res) => {
                    this.setData(res)
                    next()
                })
        },
        computed: {
            subTotal() {
                return this.form.items.reduce((carry, item) => {
                    return carry + (Number(item.unit_price) * Number(item.qty))
                }, 0)
            },
            total() {
                return this.subTotal - Number(this.form.discount)
            }
        },
         methods: {
            setData(res) {
                Vue.set(this.$data, 'form', res.data.form)

                if(this.$route.meta.mode === 'edit') {
                    this.store = `/admin/stocks/${this.$route.params.id}`
                    this.method = 'PUT'
                    this.title = 'Edit'
                }

                this.show = true
                this.$bar.finish()
            },
            addNewLine() {
                this.form.items.push({
                    product_id: null,
                    product: null,
                    unit_price: 0,
                    qty: 1
                })
            },
            onCustomer(e) {
                const customer = e.target.value
                Vue.set(this.$data.form, 'customer', customer)
                Vue.set(this.$data.form, 'customer_id', customer.id)
            },
            onProduct(index, e) {
                const product = e.target.value
                Vue.set(this.form.items[index], 'product', product)
                Vue.set(this.form.items[index], 'product_id', product.id)

                Vue.set(this.form.items[index], 'unit_price', product.unit_price)
            },
            removeItem(index) {
                this.form.items.splice(index, 1)
            },
            onCancel() {
                if(this.$route.meta.mode === 'edit') {
                    this.$router.push(`${this.resource}/${this.form.id}`)
                } else {
                    this.$router.push(`${this.resource}`)
                }
            },
            onSave() {
                this.errors = {}
                this.isProcessing = true
                byMethod(this.method, this.store, this.form)
                    .then((res) => {
                        if(res.data && res.data.saved) {
                            this.success(res)
                        }
                    })
                    .catch((error) => {
                        if(error.response.status === 422) {
                            this.errors = error.response.data.errors
                        }
                        this.isProcessing = false
                    })
            },
            success(res) {
                this.$router.push(`${this.resource}/${res.data.id}`)
            }
        }

}
</script>

<style  lang="scss" scoped>

.panel {
    background: #fff;
    margin-bottom: 16px;
    border-radius: 5px;
    // box-shadow: $box-shadow;
    &-heading {
        padding: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid skyblue;
    }
    &-body {
        padding: 8px;
    }
    &-title {
        font-size: 18px;
        line-height: 24px;
    }
    &-footer {
        padding: 8px;
        display: flex;
        align-items: center;
        border-top: 1px solid skyblue;
    }
}

.form {
    &-group {
        padding: 0 0 8px 0;
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            small {
                font-weight: normal;
            }
        }
    }
    &-control {
        color: burlywood;
        line-height: 13px;
        font-size: 13px;
        height: 32px;
        background: #fafafa;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.01);
        border-radius: 1px;
        box-shadow: inset 0 1px 1px 0 rgba(0, 0, 0, 0.1);
        padding: 8px;
        width: 100%;
        display: block;
        &:focus {
            outline-style: dotted;
            outline-width: 1px;
            outline-offset: 1px;
        }
        &[disabled] {
            opacity: 0.75px;
            cursor: not-allowed;
        }
    }
}

.error-control {
    display: block;
    color: rgb(53, 11, 11);
}

.form-table {
    width: 100%;
    border-collapse: collapse;
    th {
        text-align: left;
        padding: 5px;
        font-weight: bold;
    }
    td {
        vertical-align: top;
        padding: 5px;
    }
}

.form-summary {
    text-align: right;
    vertical-align: middle!important;
    font-weight: bold;
}

.form-remove {
    cursor: pointer;
    font-size: 16px;
    line-height: 16px;
    font-weight: bold;
    color: rgb(53, 11, 11);
}

textarea.form-control {
    height: 102px;
}



</style>