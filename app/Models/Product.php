<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['category_id','brand_id',
    'name','stock_price','sales_price','weight','carton_quantity'];
    
    protected $appends = ['text'];

    protected $cast = [
        'price'  => 'double',
        'category_id'             => 'integer',
        'brand_id'                => 'integer',
        'carton_quantity'         => 'integer'
    ];

    //********Relationships****************************** */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    /***********getters and setters ****** */

    public function getProductDescription()
    {
        return html_entity_decode($this->name."&nbsp;&nbsp;&nbsp;". $this->carton_quantity .' * '. $this->weight.' g');
    }

    public function getTextAttribute()
    {
        return $this->attributes['name'].' - '.$this->attributes['carton_quantity'].' * '.$this->attributes['weight'];
    }


    /*******boot function to auto-create and increment sku ***/

    public static function boot()
    {
        parent::boot();

        static::created(function($product){
            $product->description = $product->name." ".
                                        $product->carton_quantity." x ".
                                        $product->weight.' g';
            $product->save();
              
        });

    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::created(function($product) {
    //         $id = $product->id;

    //         if($id < 10){
    //             $product->sku .= 'SKU-00'.$product->id;
    //         }elseif($id <100)
    //         {
    //             $product->sku .= 'SKU-0' . $product->id;
    //         }
    //         $product->save();
    //     });
    // }
}
