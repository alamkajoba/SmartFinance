<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenu extends Model
{
    protected $table = 'revenus';
    protected $fillable = ['source'];
    //
     public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
