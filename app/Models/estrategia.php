<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class estrategia extends Model
{
    //

    //protected $table = 'estrategias';

    protected $fillable = ['email','nome_estrategia','capital_aloc_corr','tipo_oper','capital_dest_op','rr_gain','rr_loss','meta_f_d','meta_f_s','meta_f_m','meta_p_d','meta_p_s','meta_p_m','loss_f_d','loss_f_s','loss_f_m','loss_p_d','loss_p_s','loss_p_m', 'passo_a_passo'];
}
