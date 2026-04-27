<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorie';
    protected $fillable = ['nomCategorie'];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
