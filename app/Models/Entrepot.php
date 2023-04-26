<?php

namespace App\Models;

use App\Models\ColisDimension;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrepot extends Model
{
    use HasFactory;

    protected $fillable = [
         'name',
         'address',
         'ville'
        ];

     public function colis()
     {
        return $this->hasMany(ColisDimension::class, 'entrepot_id','id');
     }   
}
