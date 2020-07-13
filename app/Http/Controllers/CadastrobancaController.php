<?php

namespace App\Http\Controllers;

use App\Models\tradinPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CadastrobancaController extends Controller
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
        return view('Cadastrobanca', compact('user'));
    }

    public function save(Request $request)
    {
        $data = $request->all();

        tradinplan::Create($data);

        return redirect()->route('Cadastrobanca');
    }





}

