@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>System Statistics</h1>
        </div>
    </div>
    <div class="row">
           <div class="col-lg-3 col-6">
               <!-- small box student registration -->
                <div class="small-box bg-success">
                      <div class="inner">
                      <h3>{{$customers->count()}}</h3>

                          <p>Customers</p>
                      </div>
                      <div class="icon">
                          <ion-icon name="person-add"><ion-icon>
                      </div>
                    <a href="{{route('admin.customers.index')}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
           </div>
           <!-- ./col   -->

           <div class="col-lg-3 col-6">
               <!-- small box student registration -->
                <div class="small-box bg-warning">
                      <div class="inner">
                      <h3>{{ $invoices->count() }}</h3>

                          <p>Invoice Generated</p>
                      </div>
                      <div class="icon">
                          <ion-icon name="print"></ion-icon>
                      </div>
                      <a href="{{route('admin.invoices.index')}}" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                      </a>
                </div>
           </div>
           <!-- ./col   -->

           <div class="col-lg-3 col-6">
               <!-- small box student registration -->
                <div class="small-box bg-info">
                      <div class="inner">
                        <h4>GH¢ {{number_format($total_inventory,2)}} <br></h4>
                        <br>
                        <p>Inventory Amt.</p>
                      </div>

                      <div class="icon">
                          {{-- <ion-icon name="book"></ion-icon> --}}
                          
                          <ion-icon name="cash"></ion-icon>
                      </div>
                      <a href="{{route('admin.inventories.index')}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
           </div>
           <!-- ./col   -->

           <div class="col-lg-3 col-6">
               <!-- small box student registration -->
                <div class="small-box bg-danger">
                      <div class="inner">
                      <h3>{{ $total_quantity }}</h3>

                          <p>Inventory Qty.</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-houzz" aria-hidden="true"></i>
                      </div>
                      <a href="{{route('admin.inventories.index')}}" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                      </a>
                </div>
           </div>
           <!-- ./col   -->

        </div>

        @include('admin.dashboard.stock_intake_graph')

        @endsection
