<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\estrategia;
use App\Models\TradinPlan;
use App\Models\cadastrarOperacoes;
use App\Imports\cadastroOperacoes;
use DB;
use App\Http\Controllers\ApiCharts\ChartsController;



class DashboardController extends Controller
{
    private $cadastrarOperacoes;
    private $totalPage = 25;
     /**
      * Create a new controller instance.
      *
      * @return void
      */
     public function __construct(cadastrarOperacoes $cadastrarOperacoes, estrategia $estrategia, TradinPlan $tradinplan)
     {
         $this->middleware('auth');
         $this->cadastrarOperacoes  = $cadastrarOperacoes;
         $this->estrategia  = $estrategia;
         $this->TradinPlan  = $tradinplan;
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //TOTAL OPERAÇÕES

        $user = Auth()->User();
        $dataform = Auth()->User()->email;

        $resultado = $this->cadastrarOperacoes
                        ->selectRaw('SUM(resultado_operacao) as total')  
                        ->where('email', $dataform)
                        ->havingRaw('SUM(resultado_operacao)')
                        ->get();

        $countoperacoes = $this->cadastrarOperacoes 
                        ->where('email', $dataform)
                        ->count();

        $countestrategia = $this->estrategia 
                        ->where('email', $dataform)
                        ->count();

        $counttradinplan = $this->TradinPlan 
                        ->where('email', $dataform)
                        ->count();                

                      
                                

        //$avzert =  str_replace('.', ',', $avzer);
        //dd($avzert);
        //dd($totalsumoperacao);
        return view('Dashboard', compact('user', 'dataform', 'resultado','countoperacoes','countestrategia','counttradinplan'));


    }

    
}
