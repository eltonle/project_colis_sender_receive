<?php

namespace App\Models;

use App\Models\City;
use App\Models\State;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receive extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_number',
        'model_marque',
        'chassis',
        'length',
        'width',
        'unit_price',
        'qty',
        'item_total',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }
    public function countryr()
    {
        return $this->belongsTo(Country::class,'countryr_id','id');
    }
    public function stater()
    {
        return $this->belongsTo(State::class,'stater_id','id');
    }
    public function cityr()
    {
        return $this->belongsTo(City::class,'cityr_id','id');
    }
}
