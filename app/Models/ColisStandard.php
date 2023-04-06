<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColisStandard extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'quantite',
        'largeur',
        'longueur',
        'hauteur',
        'nature',
        'description',
        'poids',
        'prix',
     ];
}
