<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Distributor;
use App\Traits\HasManyRelation;


class Stock extends Model
{
    use HasManyRelation;

    protected $table = 'stocks';
    

    protected $fillable = ['distributor_id','date','reference','total'];

    protected $guarded = [
        'number', 
    ];

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }

    public function stock_items()
    {
        return $this->hasMany(StockItem::class);
    }
}
