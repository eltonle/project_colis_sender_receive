<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColisStandard extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'longueur',
        'largeur',
        'hauteur',
        'nature',
        'type',
        'capacite',
        'prix',
        'description',
        'status',
     ];
}
