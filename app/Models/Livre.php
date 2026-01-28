<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
    'titre',
    'auteur',
    'description',
    'date_publication',
    'categorie_id',
    'image',
];

    public function categorie()
    {
       return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
