<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColisPrice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'invoice_id',
        'status',
        'titre',
        'qty',
        'prix',
        'prix_unit',
        'prix_total',
    ];
    
}
