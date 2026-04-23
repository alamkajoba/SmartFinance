<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['montant', 'type', 'description'];
    //
     public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
     public function depense()
    {
        return $this->belongsTo(Depense::class);
    }
    public function revenu()
    {
        return $this->belongsTo(Revenu::class);
    }

}
