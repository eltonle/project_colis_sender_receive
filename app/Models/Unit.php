<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    protected $fillable= [
        'numero_id',
         'name',
        'Date_chagement',
        'statut',
        'description',
        'created_by',
        'updated_by'
    ];
   
}
