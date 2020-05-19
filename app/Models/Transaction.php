<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = ['invoice_or_stock','number','amount','created_at'];
}