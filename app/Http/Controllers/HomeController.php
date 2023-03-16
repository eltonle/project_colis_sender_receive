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
        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear  = Carbon::now()->format('Y');
       
        //count
        $data['thisDayPaidCount'] = Payement::whereDate('created_at',$todayDate)->count();
        $data['thisMonthPaidCount'] = Payement::whereMonth('created_at',$thisMonth)->count();
        $data['thisYearPaidCount'] = Payement::whereYear('created_at',$thisYear)->count();

        // Remise
        // $data['thisDayDiscountSum'] = Payement::whereDate('created_at',$todayDate)->sum('discount_amount');
        // $data['thisMonthDiscountSum'] = Payement::whereMonth('created_at',$thisMonth)->sum('discount_amount');
        // $data['thisYearDiscountSum'] = Payement::whereYear('created_at',$thisYear)->sum('discount_amount');
        // Paid
        $data['thisDayPaidSum'] = Payement::whereDate('created_at',$todayDate)->sum('paid_amount');
        $data['thisMonthPaidSum'] = Payement::whereMonth('created_at',$thisMonth)->sum('paid_amount');
        $data['thisYearPaidSum'] = Payement::whereYear('created_at',$thisYear)->sum('paid_amount');

        // Due_paid
        $data['thisDayDuSum'] = Payement::whereDate('created_at',$todayDate)->sum('due_amount');
        $data['thisMonthDuSum'] = Payement::whereMonth('created_at',$thisMonth)->sum('due_amount');
        $data['thisYearDuSum'] = Payement::whereYear('created_at',$thisYear)->sum('due_amount');

        // Total_paid
        $data['thisDayTotalSum'] = Payement::whereDate('created_at',$todayDate)->sum('total_amount');
        $data['thisMonthTotalSum'] = Payement::whereMonth('created_at',$thisMonth)->sum('total_amount');
        $data['thisYearTotalSum'] = Payement::whereYear('created_at',$thisYear)->sum('total_amount');
        
        // nombre d'expedition de l'annee
        $data['expeditionCountThisYear'] = Invoice::whereYear('created_at',$thisYear)->count();

        // nombre de livraison du mois
        $data['livraisonCountThisMonth'] = Invoice::whereMonth('created_at',$thisMonth)->where('status_livraison','=','livré')->count();

        /// nombre de livraison de l'annee
        $data['livraisonCountThisYear'] = Invoice::whereYear('created_at',$thisYear)->where('status_livraison','=','livré')->count();

        /// nombre de conteneur
        $data['nbrConteneur'] = Unit::whereYear('created_at',$thisYear)->count();


        // $data['sumPaidThisMonth']=Payement::sum('paid_amount');

        // dd($data);
        return view('home',$data);
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
