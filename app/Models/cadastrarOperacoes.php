<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class cadastrarOperacoes extends Model
{
    protected $fillable = ['user_id', 'ativo_operacao', 'data_abertura_operacao', 'data_fechamento_operacao', 'abertura_operacao','fechamento_operacao','tempo_operacao','qtd_operacao','lado_operacao','preco_compra_operacao','preco_venda_operacao','mep_operacao','men_operacao','medio_operacao', 'resultado_operacao', 'resultado_porcetangem', 'Total', 'nome_estrategia', 'nome_trading_plan', 'email'];

    public function user()
        {
            return $this->belongsTo(User::class);
        }

    /*public function getDatetimeAttribute($value)
        {            
                return Carbon::parse($value)->format('d/m/Y H:m:s');  
        }*/

    public function search(Array $data, $totalpage)
    {
        return $this->where(function ($query) use ($data) {


                if (isset($data['Ativo']))
                $query->where('ativo_operacao','LIKE',"%{$data['Ativo']}%");
            
                if (isset($data['Estretegia']))
                $query->where('nome_estrategia', 'LIKE',"%{$data['Estretegia']}%");

                if (isset($data['Trading_Plan']))
                $query->where('nome_trading_plan', 'LIKE',"%{$data['Trading_Plan']}%");

        })//>toSql();dd($operacoess);
        ->paginate($totalpage);
      
    }



}
