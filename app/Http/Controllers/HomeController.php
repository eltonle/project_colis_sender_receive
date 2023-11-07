<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\Payement;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {       
        return view('home');
    }

    
     // ESSAI CHARJS
     public function getDatajs( $d)
     {
         $startDate = now()->startOfDay();
         $endDate = now()->endOfDay();
 
         if ($d === 'day') {
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();
        }elseif($d == '7') {
             $startDate = now()->subDays(7)->startOfDay();
         }
         elseif ($d == '30') {
             $startDate = now()->subDays(30)->startOfDay();
         } elseif ($d == 'lastMonth') {
             $startDate = now()->subMonth()->startOfMonth();
             $endDate = now()->subMonth()->endOfMonth();
         }elseif ($d === 'thisMonth') {
             $startDate = now()->startOfMonth();
         } elseif ($d === 'thisYear') {
             $startDate = now()->startOfYear();
         } elseif ($d === 'lastYear') {
             $startDate = now()->subYear()->startOfYear();
             $endDate = now()->subYear()->endOfYear();
         }
 
         $data = DB::table('payements')
                     ->whereBetween('created_at', [$startDate, $endDate])
                     ->get();
         $payDetail = DB::table('payement_details')
                     ->whereBetween('created_at', [$startDate, $endDate])
                     ->get();
        
        
         return response()->json([$data,$payDetail]); // Retournez les données au format JSON
     }

}
