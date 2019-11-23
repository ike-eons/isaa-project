<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryClearance extends Model
{
    protected $table = 'libraryclearances';

    protected $fillable = ['clearance'];

    protected $cast = [
        'clearance' => 'Boolean'
    ];

    protected $attribute = [
        'clearance' => 0,
    ];

    public function scopeCleared($query)
    {
        return $query->where('clearance',0);
    }
    public function scopeBorrowed($query)
    {
        return $query->where('borrowed',1);
    }

    public function getLibraryClearanceOptions()
    {
        return [
            0   => 'CLEARED',
            1   => 'BORROWED'
        ];
    }

    public function getClearanceAttribute($attribute)
    {
        return $this->getLibraryClearanceOptions()[$attribute];
    }
    


    /******* Relationships */

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
