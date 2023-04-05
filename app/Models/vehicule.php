<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicule extends Model
{
    use HasFactory;
    protected $fillable =[
       
       'Immatriculation',
       'Model',
       'Type_Véhicule',
       'Numero_Serie',
       'status',
       'Description',
   ];
   public function affectation()
   {
      return $this->hasMany(Affectation::class,'affectation_id','id');
   }
}
