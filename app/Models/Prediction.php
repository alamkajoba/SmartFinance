<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $table = 'predictions';
    protected $fillable = ['user_id', 'mois', 'montantPrevu', 'precision'];
    
    protected $casts = [
        'montantPrevu' => 'float',
        'precision' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
