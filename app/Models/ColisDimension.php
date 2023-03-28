<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColisDimension extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'status',
        'titre',
        'largeur',
        'longueur',
        'hauteur',
        'description',
        'conversion',
        'type',
        'poids',
        'prix_kilo',
        'prix_vol',
        'prix',
    ];
}
