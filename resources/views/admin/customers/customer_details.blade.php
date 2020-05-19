<div class="card">
    {{-- <div class="card-header text-white" style="background: #009688">
        <h5 class="card-title m-0">
        <i class="app-menu__icon fa fa-user-circle">
        </i>
        CUSTOMER DETAILS
        </h5>
    </div> --}}
    <div class="card-header text-white" style="background:#03a595;">
        <h3 class="card-title">
            <i class="fa fa-user-circle"></i>
            Customer Details
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button> --}}
        </div>
    </div>
    <div class="card-body">
        <div class="row invoice-info">
            <div class="col-7">
            <table>
                <tr>
                <td class="text-right">Name <span class="pl-1">:</span></td>
                <td class="pl-2 py-1"><strong>{{ $targetedCustomer->getTextAttribute() }}</strong></td>
                </tr>
                <tr>
                <td class="text-right">Phone No. <span class="pl-1">:</span></td>
                <td class="pl-2 py-1"><strong>{{ $targetedCustomer->phone }}</strong></td>
                </tr>
                <tr>
                <td class="text-right">Shop Name <span class="pl-1">:</span></td>
                <td class="pl-2 py-1"><strong>{{ $targetedCustomer->shop_name }}</strong></td>
                </tr>
                <tr>
                <td class="text-right">Shop Address <span class="pl-1">:</span></td>
                <td class="pl-2 py-1"><strong>{{ $targetedCustomer->shop_address }}</strong></td>
                </tr>
                
            </table>
            </div>
        </div>
    </div>
</div>