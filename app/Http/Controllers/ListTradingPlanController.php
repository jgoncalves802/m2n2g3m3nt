<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListTradingPlanController extends Controller
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
       $tradingplan = Auth()->User()->tradingplan;
        $user = Auth()->User();

        return view('ListTradingPlan', compact('user'));
    }

    public function store(Request $request)
    {

        dd($request->nome_trading_plan);

    }





}
