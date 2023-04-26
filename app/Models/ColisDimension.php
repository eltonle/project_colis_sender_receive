<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\vehicule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ColisDimension extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'unit_id',
        'status',
        'decharge',
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

    public function conteneur()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class);
    }
    public function vehicule()
    {
        return $this->belongsTo(vehicule::class);
    }
}
