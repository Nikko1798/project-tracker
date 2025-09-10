<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceNumber extends Model
{
    //
     protected $fillable = [
        'reference_number'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
