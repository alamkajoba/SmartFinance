<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    
    protected $fillable = ['user_id', 'categorie_id', 'montant', 'type', 'description'];
    
    protected $casts = [
        'montant' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
