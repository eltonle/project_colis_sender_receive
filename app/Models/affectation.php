<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affectation extends Model
{
    use HasFactory;
    protected $fillable =[
       
      'vehicule_id',
      'chauffeur_id',
      'dateDebut',
      'dateFin',
      
      
  ];
    public function chauffeur()
    {
       return $this->belongsTo(Chauffeur::class,'chauffeur_id','id');
    }
    public function vehicule()
    {
       return $this->belongsTo(Vehicule::class,'vehicule_id','id');
    }
}
