<?php

namespace App\Http\Controllers;

use App\Models\tradinPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CadastroTradingPlanController extends Controller
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
        $user = Auth()->User();
        $corret = DB::table('correts')->get();

        //dd($user, $corret);
        return view('CadastroTradingPlan', compact('user', 'corret'));
    }

    public function save(Request $request)
    {
        $data = $request->all();

        tradinplan::Create($data);

        return redirect()->route('CadastroTradingPlan');
    }





}

