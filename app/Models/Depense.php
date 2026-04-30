<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $table = 'depenses';

    protected $fillable = [
        'user_id',
        'categorie_id',
        'transaction_id',
        'montant',
        'description',
        'date_depense'
    ];

    protected $casts = [
        'montant' => 'float',
        'date_depense' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
