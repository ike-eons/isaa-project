<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header">
        <h3 class="card-title">Purchase History</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button> --}}
        </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                    <tr>
                        <th> Date </th>
                        <th> Due Date </th>
                        <th> Invoice No </th>
                        <th> Total Amount (GH¢) </th>
                        <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        @if($invoice->customer_id == $targetedCustomer->id)
                            <tr>
                            <td>{{$invoice->date}}</td>
                                <td>{{$invoice->due_date}}</td>
                                <td><a href="{{route('admin.invoices.show',$invoice->id)}}">{{$invoice->number}}</a></td>
                                <td>GH¢ &nbsp;{{number_format($invoice->total,2)}}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </div>
</div>