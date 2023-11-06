<?php

namespace App\Models;

use App\Models\ColisDimension;
use App\Models\Entrepot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueColisEntrepot extends Model
{
    use HasFactory;

    protected $fillable = [
        'colis_id',
        'entrepot_depart_id',
        'entrepot_arrive_id',
        'date_action'
    ];

    public function colis()
    {
        return $this->belongsTo(ColisDimension::class, 'colis_id');
    }

    public function entrepotDepart()
    {
        return $this->belongsTo(Entrepot::class, 'entrepot_depart_id');
    }

    public function entrepotArrive()
    {
        return $this->belongsTo(Entrepot::class, 'entrepot_arrive_id');
    }
}
