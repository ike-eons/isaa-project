<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;


class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();

        return view('admin.inventories.index',['inventories' => $inventories]);
    }
    public function currentInventoryTotal()
    {
        
    }
}
