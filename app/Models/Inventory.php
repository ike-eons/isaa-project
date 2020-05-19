<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = ['product_id','available_quantity','availble_amount'];

    public function product()
    {
       return $this->belongsTo(Product::class);
    }
}
