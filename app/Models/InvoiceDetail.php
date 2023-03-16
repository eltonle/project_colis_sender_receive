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
        'description_colis',
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
