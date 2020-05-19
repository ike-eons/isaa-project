<?php

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        //
    }

    public static function setInventory($product_id,$product_qty,$product_amt)
    {
        DB::table('inventories')->insert([
            'product_id'    => $product_id,
            'available_quantity'    => $product_qty,
            'available_amount'      => $product_amt
        ]);
    }
}
