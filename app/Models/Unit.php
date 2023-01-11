<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'numero_id',
        'created_by',
        'updated_by'
    ];
    public function client()
    {
       return $this->hasOne(Client::class,'unit_id','id');
    }
}
