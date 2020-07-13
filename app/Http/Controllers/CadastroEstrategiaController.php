<?php

namespace App\Http\Controllers;

use App\Models\estrategia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CadastroEstrategiaController extends Controller
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
        return view('CadastroEstrategia', compact('user'));
    }

    public function save(Request $request)
    {
        $data = $request->all();

        estrategia::Create($data);

        return redirect()->route('CadastroEstrategia');
    }


}
