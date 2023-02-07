<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable =[
        'date',
        'invoice_id',
        'model_marque',
        'chassis',
        'longueur',
        'largeur',
        'hauteur',
        'qty',
        'unit_price',
        'item_total',
        'status',
    ];
}
