<?php

namespace App\Models;

use App\Models\ColisDimension;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

   public function colis()
    {
        return $this->hasMany(ColisDimension::class);
    }
}
