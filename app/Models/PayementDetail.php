<?php 

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayementDetail extends Model
{
    use HasFactory;
    protected $fillable =[
      'client_number',
      'client_id',
      'current_paid_amount',
      'date',
      'updated_by',
    ];
    public function client()
    {
       return $this->belongsTo(Client::class);
    }
}
