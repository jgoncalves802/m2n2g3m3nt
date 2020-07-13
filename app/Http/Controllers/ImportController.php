<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\estrategia;
use App\Models\cadastrarOperacoes;
use App\Imports\cadastroOperacoes;


class ImportController extends DashboardController
{
   
   private $cadastrarOperacoes;
   private $totalPage = 25;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(cadastrarOperacoes $cadastrarOperacoes)
    {
        $this->middleware('auth');
        $this->cadastrarOperacoes  = $cadastrarOperacoes;
    }


    public function import_operacoes()
    {
        $user = Auth()->User();
        
   
        $import = new cadastroOperacoes;
        
        Excel::import($import,request()->file('operacoes')); 
     
        

        return redirect()->route('CadastrarOperacoes', compact('user'));
    }

    public function cadastrarOperacoes(Request $request){

        $user = Auth()->User();
        $email = Auth()->User()->email;
        $operacoes =  $this->cadastrarOperacoes->where('email', $email)->paginate($this->totalPage);
        $id = $request->id;
        $operacao = $this->cadastrarOperacoes->where('email', $email)->where('id', $id)->first();
        $pegarid = DB::table('estrategias')->where('email', $email)->get();
        $pegarplan = DB::table('tradin_plans')->where('email', $email)->get();

        return view('CadastrarOperacoes', compact('user', 'operacoes', 'operacao', 'pegarid','pegarplan'));
    }

    public function modeloOperacoes(){

        return response()->download(public_path('/download/operacoes.xlsx'), null);
    }

    public function editarOperacoes(Request $request){
        $user = Auth()->User();
        $email = Auth()->User()->email;
        $operacoes = $this->cadastrarOperacoes->where('email', $email)->get();
        $id = $request->id;
        $operacao = $this->cadastrarOperacoes->where('email', $email)->where('id', $id)->first();
        $pegarid = DB::table('estrategias')->where('email', $email)->get();
        $pegarplan = DB::table('tradin_plans')->where('email', $email)->get();

        
       
        return view('ListOperacoes', compact('user', 'operacoes', 'operacao', 'pegarid','pegarplan'));    

    }
    public function deletarOperacoes(Request $request){
        $user = Auth()->User();
        $email = Auth()->User()->email;
        $operacoes = $this->cadastrarOperacoes->where('email', $email)->get();
        $id = $request->id;
        $operacao = $this->cadastrarOperacoes->where('email', $email)->where('id', $id)->first();
        $pegarid = DB::table('estrategias')->where('email', $email)->get();
        $pegarplan = DB::table('tradin_plans')->where('email', $email)->get();

        
       
        return view('DeleteOperacoes', compact('user', 'operacoes', 'operacao', 'pegarid','pegarplan'));    

    }
    public function update(Request $request, $id)
    {   $user = Auth()->User();
        $email = Auth()->User()->email;
        $dataform = $request->all();
        $operacao = $this->cadastrarOperacoes::find($id);
        $update = $operacao->update($dataform);

      
   
        if($update)

            return redirect()->route('CadastrarOperacoes', compact('user'));
        
        else 
            return redirect()->route('operacoes.edit', $id)->with(['errors'=> 'Falha ao Editar']);
    }
    public function destroy(Request $request, $id)
    {   $user = Auth()->User();
        $email = Auth()->User()->email;
        $dataform = $request->id;
        $operacao = $this->cadastrarOperacoes::find($dataform);
        $delete = $operacao->delete();
    
        if($delete)
    
            return redirect()->route('CadastrarOperacoes', compact('user'));
        
        else 
            return redirect()->route('operacoes.delete', $id)->with(['errors'=> 'Falha ao Deletar']);
    }
    public function destroyall(Request $request, $email)
    {   
        $user = Auth()->User();
        $email = Auth()->User()->email;
        $dataform = $request->email;
        $operacao = $this->cadastrarOperacoes::where('email', $dataform);
        $delete = $operacao->delete();
    
        if($delete)
    
            return redirect()->route('CadastrarOperacoes', compact('user'));
        
        else 
            return redirect()->route('operacoes.delete', $email)->with(['errors'=> 'Falha ao Deletar']);
    }
    
    public function searchFiltro(Request $request, CadastrarOperacoes $cadastrarOperacoes)
    {
        $user = Auth()->User();
        $email = Auth()->User()->email;
        $dataform = $request->except('_token');
       // $operacoes =  $this->cadastrarOperacoes->where('email', $email)->paginate($this->totalPage);
        
        $operacoes = $cadastrarOperacoes->search($dataform, $this->totalPage);
        $id = $request->id;
        $pegarid = DB::table('estrategias')->where('email', $email)->get();
        $pegarplan = DB::table('tradin_plans')->where('email', $email)->get();
        
        return view('CadastrarOperacoes', compact('user', 'operacoes','dataform', 'pegarid', 'pegarplan'));

    }

}

   
