<?php

namespace App\Imports;

use Illuminate\Http\Request;
use App\Models\cadastrarOperacoes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class cadastroOperacoes implements ToModel, WithHeadingRow
{

    private $rows = 0;

    public function model(array $row)
    {


        ++$this->rows;


            $user_id = Auth::user()->id;
            $email = Auth::user()->email;

            $date = $row["abertura_operacao"];
            $UNIX_DATE = ($date - 25569) * 86400;
            $data = gmdate("Y-m-d H:i:s", $UNIX_DATE);

            $date2 = $row["fechamento_operacao"];
            $UNIX_DATE2 = ($date2 - 25569) * 86400;
            $data2 = gmdate("Y-m-d H:i:s", $UNIX_DATE2);


            $data_abertura = gmdate("Y-m-d ", $UNIX_DATE);

            $data_fechamento = gmdate("Y-m-d H:i:s", $UNIX_DATE2);



            return new cadastrarOperacoes([

           'user_id'              => $user_id,
           'ativo_operacao'       => $row['ativo'],
           'abertura_operacao'    => $data,
           'fechamento_operacao'  => $data2,
           'tempo_operacao'       => $row['tempo_operacao'],
           'qtd_operacao'         => $row['qtd_operacao'],
           'lado_operacao'        => $row['lado_operacao'],
           'preco_compra_operacao'=> $row['preco_compra'],
           'preco_venda_operacao' => $row['preco_venda'],
           'mep_operacao'         => $row['mep_operacao'],
           'men_operacao'         => $row['men_operacao'],
           'medio_operacao'       => $row['medio_operacao'],
           'resultado_operacao'   => $row['resultado_operacao'],
           'resultado_porcetangem'=> $row['resultado_porcetangem'],
           'Total'                => $row['total'],
           'data_abertura_operacao'=> $data_abertura,
           'data_fechamento_operacao'=> $data_fechamento,
           'email'                => $email,

         ]);

    }
}
