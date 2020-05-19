<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['firstname','lastname','phone','shop_name','shop_addresss'];

    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->attributes['firstname']. ' - '.$this->attributes['lastname'];
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
