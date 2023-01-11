<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Receive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    public function clients()
    {
       return $this->hasMany(Client::class,'country_id','id');
    }
    public function receivesr()
    {
       return $this->hasMany(Receive::class,'countryr_id','id');
    }
}
