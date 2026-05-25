<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    protected $table = 'alertes';
    protected $fillable = [
        'user_id',
        'type',
        'niveau',
        'categorie',
        'message',
        'montant',
        'is_read',
        'date_alerte'
    ];

    protected $casts = [
        'montant' => 'float',
        'is_read' => 'boolean',
        'date_alerte' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
