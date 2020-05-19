<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Distributor;

class Distributor extends Model
{
    protected $table = "distributors";

    protected $fillable = ['company_name','address',
                            'phone','email'];
}
