<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'marque',
        'model',
        'type',
        'status',
        'category_id',
        'unit_id',
        'created_by',
        'updated_by',
    ];
}
