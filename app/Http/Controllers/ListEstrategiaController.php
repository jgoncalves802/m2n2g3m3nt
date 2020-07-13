<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\estrategia;

class ListEstrategiaController extends Controller
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
    public function index(Request $request)
    {
        $user = Auth()->User();
        $email = Auth()->User()->email;
        $pegarid = DB::table('estrategias')->where('email', $email)->get();
        //$estrategias = DB::table('estrategias')->where('id', '$name_estrategia')->get();
       // dd($pegarid);
        if ($pegarid->isNotEmpty())

            return view('ListEstrategia', compact('user', 'pegarid'));


        else
            return view('CadastroEstrategia', compact('user', 'pegarid'))
                 ->with(['errors' => 'Você não Possui estratégia Cadastradas']);

    }

    public function estrategia(Request $request)
    {
        return view('ListEstrategia', compact('user', 'pegarid'))->with(['errors' => 'Você não Possui estratégia Cadastradas']);

    }

    public function edit(Request $request)
    {
        $editar = $request->all();
        dd($editar);

    }




}
