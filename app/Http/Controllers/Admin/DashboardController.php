<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Inventory;

class DashboardController extends Controller
{
    public function index(){
        
        $customers = Customer::all();
        $invoices = Invoice::all();

        $inventories = Inventory::all();

        $total_inventory = 0;
        $total_quantity = 0;

        foreach($inventories as $inventory)
        {
            $total_inventory += $inventory->available_amount;
            $total_quantity += $inventory->available_quantity;
        }

        return view('admin.dashboard.index',['customers'=>$customers,
                                'invoices'=>$invoices,
                                'total_quantity' => $total_quantity,
                                'total_inventory' => $total_inventory ]
                );
    }

}
