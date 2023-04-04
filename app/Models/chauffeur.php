<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chauffeur extends Model
{
    use HasFactory;
    protected $fillable =[
       
      'nom',
      'prenom',
      'email',
      'address',
      'phone',
      
  ];
    public function affectation()
   {
      return $this->hasMany(Affectation::class,'affectation_id','id');
   }
}
