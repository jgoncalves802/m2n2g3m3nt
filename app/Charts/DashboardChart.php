<?php

declare(strict_types = 1);

namespace App\Charts;

use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Chartisan\PHP\Chartisan;
use DB;



class DashboardChart extends BaseChart
{
    

    public function handler(Request $request): Chartisan
    { 

        //$user =$request->getUserResolver();
        
       
      // dd($request);

        $date = DB::table('cadastrar_operacoes')
                                        ->selectRaw(DB::raw('Day(data_abertura_operacao) as dia'))
                                        //->where('email', $dataform)
                                        ->groupBy(DB::raw('Day(data_abertura_operacao)'))
                                        ->pluck('dia')
                                        ->toArray(); 

        // Converte da data para o formato americano: Ano-mês-dia (Y-m-d) 
       // $dateFormated = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y'); 

 //dd($dias);

        $sumdias = DB::table('cadastrar_operacoes')
                                        ->selectRaw(DB::raw('count(resultado_operacao) as total'))
                                        //->where('email', $dataform)
                                        ->groupBy(DB::raw('Day(data_abertura_operacao)'))
                                        ->pluck('total')
                                        ->toArray();

        return Chartisan::build()
            ->labels($date)
            ->dataset('Operações', $sumdias);
    }
}
