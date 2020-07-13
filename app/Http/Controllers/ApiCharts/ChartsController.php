<?php

namespace App\Http\Controllers\ApiCharts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\estrategia;
use App\Models\TradinPlan;
use App\Models\cadastrarOperacoes;
use App\Imports\cadastroOperacoes;
use DB;


class ChartsController extends Controller
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

     public function resultado(Request $request) {
        //$logado = \Auth::guard('web')->check()? \Auth::guard('web')->user() : \Auth::guard('api')->user();
            /*Dados usuario*/
            $user = Auth()->User();
            $id = Auth()->user()->id;
            $dataform = Auth()->User()->email;

             /*Data retornada pelo filtro*/
            $data_inicio =  $request->input('data_inicio');
            $data_termino = $request->input('data_termino');


            /*contagem operacoes*/
            $avpos = ['total'=>'0'];
            $avneg = ['total'=>'0'];
            $avzer = ['total'=>'0'];

            $totaloperacao = $this->cadastrarOperacoes
                            ->where('email', $dataform)
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->count();

            $operacoespos = $this->cadastrarOperacoes
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->where('resultado_operacao','<','0')
                            ->count();

            if ($totaloperacao == "0")
                $avpos = "0";
            else
                $avposdiv = $operacoespos/$totaloperacao*100;
                $avpos = substr($avposdiv,0,5);
            $operacoesneg = $this->cadastrarOperacoes
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->where('resultado_operacao','>','0')
                            ->count();

            if ($totaloperacao == "0")
                $avneg = "0";
            else
                $avnegdiv = $operacoesneg/$totaloperacao*100;
                $avneg = substr($avnegdiv,0,5);

            $operacoeszer = $this->cadastrarOperacoes
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->where('resultado_operacao','=','0')
                            ->count();
            if ($totaloperacao == "0")
                $avzer = "0";
            else
                $avzerdiv = $operacoeszer/$totaloperacao*100;
                $avzer = substr($avzerdiv,0,5);

            /*valores*/
            $totalsum = $this->cadastrarOperacoes
                            ->selectRaw('SUM(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('SUM(resultado_operacao)')
                            ->get();
            if ($totalsum === "0")
            $totalsumoperacao = ['total'=>'0'];
            else


            $totalsumoperacao = $this->cadastrarOperacoes
                            ->selectRaw('SUM(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('SUM(resultado_operacao)')
                            ->get();

            $melhoroperacao = $this->cadastrarOperacoes
                            ->selectRaw('MAX(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('MAX(resultado_operacao)')
                            ->get();
            $menoroperacao = $this->cadastrarOperacoes
                            ->selectRaw('MIN(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('MIN(resultado_operacao)')
                            ->get();




        //dd($data_inicio,$data_termino);
        $date = $this->cadastrarOperacoes
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('data_abertura_operacao')
                ->pluck('data_abertura_operacao')
                ->toArray();



        $sumdias = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('SUM(resultado_operacao) as total'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('data_abertura_operacao')
                ->pluck('total')
                ->toArray();

        $data = [
                'totaloperacao' => $totaloperacao,
                'operacoespos' => $operacoespos,
                'avpos' => $avpos,
                'operacoesneg' => $operacoesneg,
                'avneg' => $avneg,
                'operacoeszer' => $operacoeszer,
                'avzer' => $avzer,
                'totalsumoperacao' => $totalsumoperacao,
                'melhoroperacao' => $melhoroperacao,
                'menoroperacao' => $menoroperacao,
                'labels' => $date,
                'values' =>$sumdias,];

        return response()->json($data);

     }
     public function operacoes(Request $request) {
        //$logado = \Auth::guard('web')->check()? \Auth::guard('web')->user() : \Auth::guard('api')->user();
            /*Dados usuario*/
            $user = Auth()->User();
            $id = Auth()->user()->id;
            $dataform = Auth()->User()->email;

            /*Data retornada pelo filtro*/
            $data_inicio =  $request->input('data_inicio');
            $data_termino = $request->input('data_termino');


            /*contagem operacoes*/
            $avpos = ['total'=>'0'];
            $avneg = ['total'=>'0'];
            $avzer = ['total'=>'0'];

            $totaloperacao = $this->cadastrarOperacoes
                            ->where('email', $dataform)
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->count();

            $operacoespos = $this->cadastrarOperacoes
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->where('resultado_operacao','<','0')
                            ->count();

            if ($totaloperacao == "0")
                $avpos = "0";
            else
                $avposdiv = $operacoespos/$totaloperacao*100;
                $avpos = substr($avposdiv,0,5);
            $operacoesneg = $this->cadastrarOperacoes
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->where('resultado_operacao','>','0')
                            ->count();

            if ($totaloperacao == "0")
                $avneg = "0";
            else
                $avnegdiv = $operacoesneg/$totaloperacao*100;
                $avneg = substr($avnegdiv,0,5);

            $operacoeszer = $this->cadastrarOperacoes
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->where('resultado_operacao','=','0')
                            ->count();
            if ($totaloperacao == "0")
                $avzer = "0";
            else
                $avzerdiv = $operacoeszer/$totaloperacao*100;
                $avzer = substr($avzerdiv,0,5);

            /*valores*/
            $totalsum = $this->cadastrarOperacoes
                            ->selectRaw('SUM(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('SUM(resultado_operacao)')
                            ->get();
            if ($totalsum === "0")
            $totalsumoperacao = ['total'=>'0'];
            else


            $totalsumoperacao = $this->cadastrarOperacoes
                            ->selectRaw('SUM(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('SUM(resultado_operacao)')
                            ->get();

            $melhoroperacao = $this->cadastrarOperacoes
                            ->selectRaw('MAX(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('MAX(resultado_operacao)')
                            ->get();
            $menoroperacao = $this->cadastrarOperacoes
                            ->selectRaw('MIN(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('MIN(resultado_operacao)')
                            ->get();




        //dd($data_inicio,$data_termino);
        $date = $this->cadastrarOperacoes
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('data_abertura_operacao')
                ->pluck('data_abertura_operacao')
                ->toArray();



        $sumdiaspos = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('count(resultado_operacao) as total'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->where('resultado_operacao','<','0')
                ->groupBy('data_abertura_operacao')
                ->pluck('total')
                ->toArray();
        $sumdiasneg = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('count(resultado_operacao) as total'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->where('resultado_operacao','>','0')
                ->groupBy('data_abertura_operacao')
                ->pluck('total')
                ->toArray();
        $sumdiaszer = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('count(resultado_operacao) as total'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->where('resultado_operacao','=','0')
                ->groupBy('data_abertura_operacao')
                ->pluck('total')
                ->toArray();


        $data = [
                'totaloperacao' => $totaloperacao,
                'operacoespos' => $operacoespos,
                'avpos' => $avpos,
                'operacoesneg' => $operacoesneg,
                'avneg' => $avneg,
                'operacoeszer' => $operacoeszer,
                'avzer' => $avzer,
                'totalsumoperacao' => $totalsumoperacao,
                'melhoroperacao' => $melhoroperacao,
                'menoroperacao' => $menoroperacao,
                'labels' => $date,
                'values' =>$sumdiaspos,
                'values1' =>$sumdiasneg,
                'values2' =>$sumdiaszer,
            ];

        return response()->json($data);

     }
     public function estrategia(Request $request) {
         //$logado = \Auth::guard('web')->check()? \Auth::guard('web')->user() : \Auth::guard('api')->user();
            /*Dados usuario*/
            $user = Auth()->User();
            $id = Auth()->user()->id;
            $dataform = Auth()->User()->email;

            /*Data retornada pelo filtro*/
            $data_inicio =  $request->input('data_inicio');
            $data_termino = $request->input('data_termino');


            /*valores*/
            $totalsum = $this->cadastrarOperacoes
                            ->selectRaw('SUM(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('SUM(resultado_operacao)')
                            ->get();
            if ($totalsum === "0")
            $totalsumoperacao = ['total'=>'0'];
            else


            $totalsumoperacao = $this->cadastrarOperacoes
                            ->selectRaw('SUM(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('SUM(resultado_operacao)')
                            ->get();

            $melhoroperacao = $this->cadastrarOperacoes
                            ->selectRaw('MAX(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('MAX(resultado_operacao)')
                            ->get();
            $menoroperacao = $this->cadastrarOperacoes
                            ->selectRaw('MIN(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('MIN(resultado_operacao)')
                            ->get();




        //dd($data_inicio,$data_termino);
        $est = $this->cadastrarOperacoes
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('nome_estrategia')
                ->pluck('nome_estrategia')
                ->toArray();



        $countest = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('count(id) as total_operacoes'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('nome_estrategia')
                ->pluck('total_operacoes')
                ->toArray();
        $sumest = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('SUM(resultado_operacao) as sum_result'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('nome_estrategia')
                ->pluck('sum_result')
                ->toArray();
        $sumcont = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('SUM(qtd_operacao) as sum_cont'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('nome_estrategia')
                ->pluck('sum_cont')
                ->toArray();


        $data = [
                'totalsumoperacao' => $totalsumoperacao,
                'melhoroperacao' => $melhoroperacao,
                'menoroperacao' => $menoroperacao,
                'labels' => $est,
                'values' => $countest,
                'values1' => $sumest,
                'values2' => $sumcont,
            ];

        return response()->json($data);

     }
     public function ativo(Request $request) {
        //$logado = \Auth::guard('web')->check()? \Auth::guard('web')->user() : \Auth::guard('api')->user();
            /*Dados usuario*/
            $user = Auth()->User();
            $id = Auth()->user()->id;
            $dataform = Auth()->User()->email;

            /*Data retornada pelo filtro*/
            $data_inicio =  $request->input('data_inicio');
            $data_termino = $request->input('data_termino');


            /*valores*/
            $totalsum = $this->cadastrarOperacoes
                            ->selectRaw('SUM(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('SUM(resultado_operacao)')
                            ->get();
            if ($totalsum === "0")
            $totalsumoperacao = ['total'=>'0'];
            else


            $totalsumoperacao = $this->cadastrarOperacoes
                            ->selectRaw('SUM(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('SUM(resultado_operacao)')
                            ->get();

            $melhoroperacao = $this->cadastrarOperacoes
                            ->selectRaw('MAX(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('MAX(resultado_operacao)')
                            ->get();
            $menoroperacao = $this->cadastrarOperacoes
                            ->selectRaw('MIN(resultado_operacao) as total')
                            ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                            ->where('email', $dataform)
                            ->havingRaw('MIN(resultado_operacao)')
                            ->get();




        //dd($data_inicio,$data_termino);
        $est = $this->cadastrarOperacoes
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('ativo_operacao')
                ->pluck('ativo_operacao')
                ->toArray();



        $countest = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('count(id) as total_operacoes'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('ativo_operacao')
                ->pluck('total_operacoes')
                ->toArray();
        $sumest = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('SUM(resultado_operacao) as sum_result'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('ativo_operacao')
                ->pluck('sum_result')
                ->toArray();
        $sumcont = $this->cadastrarOperacoes
                ->selectRaw(cadastrarOperacoes::raw('SUM(qtd_operacao) as sum_cont'))
                ->where('user_id', $id)
                ->whereBetween('data_abertura_operacao', [$data_inicio, $data_termino])
                ->groupBy('ativo_operacao')
                ->pluck('sum_cont')
                ->toArray();


        $data = [
                'totalsumoperacao' => $totalsumoperacao,
                'melhoroperacao' => $melhoroperacao,
                'menoroperacao' => $menoroperacao,
                'labels' => $est,
                'values' => $countest,
                'values1' => $sumest,
                'values2' => $sumcont,
            ];

       return response()->json($data);

    }
}
