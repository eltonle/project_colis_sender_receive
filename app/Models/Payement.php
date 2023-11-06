<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payement extends Model
{
    use HasFactory;
    protected $fillable =[
      'client_number',
      'client_id',
      'paid_status',
      'paid_amount',
      'due_amount',
      // 'discount_amount',
    ];
    public function customer()
    {
       return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function receive()
    {
       return $this->belongsTo(Customer::class,'receive_id','id');
    }
   //  public function receive()
   //  {
   //     return $this->belongsTo(Receive::class,'receive_id','id');
   //  }
    public function invoice()
    {
       return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}
