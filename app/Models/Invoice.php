<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasManyRelation;
use App\Models\InvoiceItem;
use App\Models\Customer;
use App\Models\Invoice;

class Invoice extends Model
{
    use HasManyRelation;

    protected $table = 'invoices';

    protected $fillable = [
        'customer_id', 'date', 'due_date', 'reference','total'
    ];

    protected $guarded = [
        'number','total'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function setSubTotalAttribute($value)
    {
        $this->attributes['sub_total'] = $value;
        $discount = $this->attributes['discount'];
        $this->attributes['total'] = $value - $discount;
    }
}
