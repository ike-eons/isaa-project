<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['name'];

    /*** Relationships*****************************/

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
