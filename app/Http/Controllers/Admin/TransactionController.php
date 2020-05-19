<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('admin.transactions.index',['transactions' => $transactions]);
    }
    public function currentInventoryTotal()
    {
        $inventories = Inventory::all();

        $total = 0;

        foreach($inventories as $inventory)
        {
            if($inventory->invoice_or_stock == 'stock'){
                $total += $inventory->amount;
            }elseif($inventory->invoice_or_stock =='invoice')
            {
                $total -=$inventory->amount;
            }
        }

        return $total;
    }
}
