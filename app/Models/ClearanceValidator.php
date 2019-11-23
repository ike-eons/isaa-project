<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceValidator extends Model
{
    protected $table = 'clearancevalidators';

    protected $fillable  = ['fee','attendance','library'];

      protected $attribute = [
        'library' => 0,
    ];

    public function scopeCleared($query)
    {
        return $query->where('cleared',0);
    }
    public function scopeBorrowed($query)
    {
        return $query->where('borrowed',1);
    }

    public function getLibraryOptions()
    {
        return [
            0   => 'CLEARED',
            1   => 'BORROWED'
        ];
    }

    public function getLibraryAttribute($attribute)
    {
        return $this->getLibraryOptions()[$attribute];
    }
    
}
