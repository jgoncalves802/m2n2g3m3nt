<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradinPlan extends Model
{
    protected $fillable = ['email','nome_trading_plan','tipo_oper','capital_dest_op','corret'];

}
