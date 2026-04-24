<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = ['categorie'];
    //
     public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
