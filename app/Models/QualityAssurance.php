<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualityAssurance extends Model
{
    protected $table = 'qualityassurances';

     public function student()
     {
         return $this->belongsTo(Student::class);
     }
}
