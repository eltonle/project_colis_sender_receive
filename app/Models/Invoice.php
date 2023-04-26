<?php

namespace App\Models;

use App\Models\ColisDimension;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    public function payement()
    { 
       return $this->belongsTo(Payement::class,'id','invoice_id');
    }

   //  public function colisDimension()
   //  { 
   //     return $this->belongsTo(ColisDimension::class,'invoice_id','id');
   //  }

    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }

    public function colis_dimensions()
    {
        return $this->hasMany(ColisDimension::class,'invoice_id','id');
    }


    public function unit()
    {
       return $this->belongsTo(Country::class,'unit_id','id');
    }
    
    public function country()
    {
       return $this->belongsTo(Country::class,'country_id','id');
    }
    public function state()
    {
       return $this->belongsTo(State::class,'state_id','id');
    }


    public function countryr()
    {
       return $this->belongsTo(Country::class,'countryr_id','id');
    }
    public function stater()
    {
       return $this->belongsTo(State::class,'stater_id','id');
    }
}
