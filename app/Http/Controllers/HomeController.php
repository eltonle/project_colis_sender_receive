<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payement;
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

    public function chartjs(Request $request)
    {
      $group = $request->query('group','month');
      $query = Payement::select([
          DB::raw('SUM(paid_amount) as paid_amount'),
          DB::raw('SUM(due_amount) as due_amount'),
          DB::raw('SUM(total_amount) as total_amount'),
          DB::raw('COUNT(*) as count'),
      ])->groupBy([
          'label'
      ])->orderBy('label');

      switch($group){
        case 'day':
          $query->addSelect(DB::raw('DATE(created_at) as label'));
          $query->whereDate('created_at','>=',Carbon::now()->startOfMonth());
          $query->whereDate('created_at','<=',Carbon::now()->endOfMonth());

          break;
        case 'week':
          $query->addSelect(DB::raw('DATE(created_at) as label'));
          $query->whereDate('created_at','>=',Carbon::now()->startOfWeek());
          $query->whereDate('created_at','<=',Carbon::now()->endOfWeek());
         
          break;
        case 'year':
          $query->addSelect(DB::raw('YEAR(created_at) as label'));
          $query->whereYear('created_at','>=',Carbon::now()->subYears(5)->year);
          $query->whereYear('created_at','<=',Carbon::now()->addYears(4)->year);
          
          break;
        case 'month':
          $query->addSelect(DB::raw('MONTH(created_at) as label'));
          $query->whereDate('created_at','>=',Carbon::now()->startOfYear());
          $query->whereDate('created_at','<=',Carbon::now()->endOfYear());
        
          default:
      }

      $entries = $query ->get();

      $labels = $total = $paid = $due = [];

      foreach ($entries as $entry) {
        $labels[]= $entry->label;
        $total[$entry->label]= $entry->total_amount;
        $paid[$entry->label]= $entry->paid_amount;
        $due[$entry->label]= $entry->due_amount;
        $count[$entry->label]= $entry->count;
    }

    return[
        'group'=>$group,
        'labels'=> array_values($labels),
        'datasets'=>[
            [
                'label'=>'Montant Total',
                'borderColor'=>'',
                'backgroundColor'=>'',
                'data'=>array_values($total)
            ],
            [
                'label'=>'Montant Paye',
                'borderColor'=>'#0abde3',
                'backgroundColor'=>'#0abde3',
                'data'=>array_values($paid)
            ],
            [
                'label'=>'Montant due',
                'borderColor'=>'#c23616',
                'backgroundColor'=>'#c23616',
                'data'=>array_values($due)
            ],
            
            [
                'label'=>'Orders',
                'borderColor'=>'darkGreen',
                'backgroundColor'=>'darkGreen',
                'data'=>array_values($count)
            ],
        ],
    ];


    }

}
