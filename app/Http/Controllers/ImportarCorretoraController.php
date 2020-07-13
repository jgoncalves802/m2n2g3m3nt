<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Corret;
use App\Imports\CorretImports;

class ImportarCorretoraController extends Controller
{
    public function index()
    {
        $user = Auth()->User();
        return view('CadastrarCorretora', compact('user'));
    }


    public function save()
    {
        $user = Auth()->User();
        
   
        $import = new CorretImports;
        
       
        Excel::import($import,request()->file('corretoras'));
        

        return redirect()->route('CadastrarCorretora', compact('user'));
    }
}
