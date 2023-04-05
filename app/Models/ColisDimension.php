<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function invoice()
    {
       return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}
