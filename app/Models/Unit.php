<?php

namespace App\Models;

use App\Models\Client;
use App\Models\ColisDimension;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    protected $fillable= [
        'numero_id',
         'name',
        'max_capacity',
        'Date_chagement',
        'statut',
        'description',
        'created_by',
        'updated_by'
    ];

    public function colisDimensions() 
    {
        return $this->hasMany(ColisDimension::class);
    }

    public function colis()
    {
        return $this->belongsToMany(ColisDimension::class, 'colis_unit', 'unit_id', 'colis_id')
            ->withPivot('date');
    }

    public function colis_historiques()
    {
        return $this->belongsToMany(ColisDimension::class, 'historique_colis_conteneurs', 'unit_id', 'colis_id')
            ->withPivot('status', 'date_action');
    }
   
}