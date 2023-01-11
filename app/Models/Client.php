<?php

namespace App\Models;

use App\Models\City;
use App\Models\Unit;
use App\Models\State;
use App\Models\Country;
use App\Models\Receive;
use App\Models\Payement;
use App\Models\PayementDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_number',
        'name',
        'firstname',
        'phone',
        'email',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'sub_total',
        'tax_1',
        'discount',
        'grand_total',
        'description',
        'created_by',
        'updated_by',
        'status_livraison',
        'unit_id',
    ];
    public function receives()
    {
        return $this->hasMany(Receive::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function payements()
    {
        return $this->hasMany(Payement::class,'client_id','id');
    }
    public function payement_detail()
    {
        return $this->hasOne(PayementDetail::class,'client_id','id');
    }
    public function package()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
}
