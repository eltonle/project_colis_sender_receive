<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\vehicule;
use App\Models\HistoriqueColisEntrepot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ColisDimension extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'unit_id',
        'status',
        'livre',
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

   
    
    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class);
    }
  
    // public function vehicule()
    // {
    //     return $this->belongsTo(vehicule::class);
    // }
    public function conteneurs()
    {
        return $this->belongsToMany(Unit::class, 'colis_unit', 'colis_id', 'unit_id')
         ->withPivot('date');
    }

    // COLIS ET ENTREPOTS
    public function historiques_colis()
    {
        return $this->hasMany(HistoriqueColisEntrepot::class, 'colis_id');  
    }

    public function conteneurs_historiques()
    {
        return $this->belongsToMany(Unit::class, 'historique_colis_conteneurs', 'colis_id', 'unit_id')
            ->withPivot('status', 'date_action');
    }

}
