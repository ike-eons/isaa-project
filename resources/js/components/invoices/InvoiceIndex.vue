<template>
  <div class="row">
      <div class="col-md-12">
        <div class="tile">
            <div class="row pb-3">
                <div class="col-md-12">
                    <div class="tile-header">
                        <!-- <a href="/invoices/create" class="btn btn-primary pull-right">new Invoice</a> -->
                    </div>
                </div>
            </div>
            
            <div class="tile-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th style="with:20%"> Date </th>
                            <th> Number </th>
                            <th> Customer </th>
                            <th> Due Date </th>
                            <th> Total </th>
                            
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        <tr v-for="invoice in allInvoices" :key="invoice.id" class="py-0 text-center" >
                            <td class="align-middle py-0">
                                <a href="#" class="nav-link text-info font-weight-bold">
                                    {{ invoice.id }}
                                </a> 
                            </td>
                            <td style="width: 10%">{{invoice.date}}</td>
                            <td >{{invoice.number}}</td>
                            <td >{{invoice.customer.text}}</td>
                            <td >{{invoice.due_date}}</td>
                            <td >{{invoice.total}}</td>
                            
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Second group">
                                <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                            
                        </tr>
                    </thead>
                </table>
           
                 </div>
             </div>
      </div>
  </div>
</template>

<script>

import {mapGetters,mapActions,mapState} from 'vuex';

export default {
    data(){
        return{

        }
    },
    computed:{
        ...mapGetters(['allInvoices']),
    },
    methods:{
        ...mapActions(['fetchInvoices']),
        loadInvoiceForm(){
            
        }
    },
    created(){
        this.fetchInvoices();
    }
}
</script>

<style>

</style>