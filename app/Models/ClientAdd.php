<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAdd extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_number',
        'model_marque',
        'chassis',
        'length',
        'width',
        'height',
        'unit_price',
        'qty',
        'item_total',
    ];
}
