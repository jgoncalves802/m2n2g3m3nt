@extends('Painel.Layouts.index')

@section('content')
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
        @include('Painel.Layouts.navbbar')
        <!-- Content Wrapper. Contains page content -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
               
                  <h1>Editar Operações</h1>
                  <a href="{{ route('CadastrarOperacoes') }}" class="btn btn-primary" style="margin-top: 10px">Voltar</a>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Editar Operações</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

       <form action="{{ route('operacoes.update', ['id' => $operacao->id]) }}" method="post">
         @csrf
         @method('PUT')

         <div class="card">
          <div class="container card-body col-md-12" style="margin-top:10px; margin-bottom:10px;">

            <h3>Operação</h3>
              <div class="row">
                <div class="form col-sm-2" >
                  <label>Ativo</label>
                  <input type="hidden" class="form-control" name="email" value={{ Auth::user()->id }} placeholder="user_id">
                  <input type="text" class="form-control" name="ativo_operacao" value="{{$operacao->ativo_operacao}}" placeholder="Ativo">
                </div>
                <div class="form col-sm-2" >
                  <label>Abertura Operação</label>
                  <input type="text" class="form-control" name="abertura_operacao " value="{{$operacao->abertura_operacao}}" placeholder="Abertura">
                </div>
                <div class="form col-sm-2" >
                  <label>Fechamento Operação</label>
                  <input type="text" class="form-control" name="fechamento_operacao" value="{{$operacao->fechamento_operacao}}" placeholder="Fechamento">
                </div>
                <div class="form col-sm-2" >
                  <label>Tempo Operação</label>
                  <input type="text" class="form-control" name="tempo_operacao" value="{{$operacao->tempo_operacao}}" placeholder="Tempo da Operação">
                </div>
                <div class="form col-sm-2" >
                  <label>Qtd de Contratos</label>
                  <input type="text" class="form-control" name="qtd_operacao" value="{{$operacao->qtd_operacao}}" placeholder="Quant. de Contratos">
                </div>
                <div class="form col-sm-2" >
                  <label>Lado</label>
                  <input type="text" class="form-control" name="lado_operacao" value="{{$operacao->lado_operacao}}" placeholder="Lado">
                </div>
                <div class="form col-sm-2" >
                  <label>Preco Compra</label>
                  <input type="text" class="form-control" name="preco_compra_operacao" value="{{$operacao->preco_compra_operacao}}" placeholder="Preco Compra">
                </div>
                <div class="form col-sm-2" >
                  <label>Preco Venda</label>
                  <input type="text" class="form-control" name="preco_venda_operacao" value="{{$operacao->preco_venda_operacao}}" placeholder="Preco Venda">
                </div>
                <div class="form col-sm-2" >
                  <label>Mep</label>
                  <input type="text" class="form-control" name="mep_operacao" value="{{$operacao->mep_operacao}}" placeholder="Mep">
                </div>
                <div class="form col-sm-2" >
                  <label>Men</label>
                  <input type="text" class="form-control" name="men_operacao" value="{{$operacao->men_operacao}}" placeholder="Men">
                </div>
                <div class="form col-sm-2" >
                  <label>Médio</label>
                  <input type="text" class="form-control" name="medio_operacao" value="{{$operacao->medio_operacao}}" placeholder="Médio">
                </div>
                <div class="form col-sm-2" >
                  <label>Resultado (R$)</label>
                  <input type="text" class="form-control" name="resultado_operacao" value="{{$operacao->resultado_operacao}}" placeholder="Resultado (R$)">
                </div>
                <div class="form col-sm-2" >
                  <label>Resultado (%)</label>
                  <input type="text" class="form-control" name="resultado_porcetangem" value="{{$operacao->resultado_porcetangem}}" placeholder="Resultado (%)">
                </div>
                <div class="form col-sm-2" >
                  <label>Total</label>
                  <input type="text" class="form-control " name="Total" value="{{$operacao->Total}}" placeholder="Resultado Total">
                </div>
                <div class="form col-sm-2" >
                  <label>Nome Estratégia</label>
                  <select  class="form-control badge" name="nome_estrategia" id="nome_estrategia"  style="font-size: 12px;">
                    <option value="">-- Selecione a Estratégia --</option>
                  @foreach($pegarid as $estrategia)
                    <option value={{$estrategia->nome_estrategia}}>{{$estrategia->nome_estrategia}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form col-sm-2">
                  <label>Nome Trading Plan</label>
                  <select  class="form-control badge" name="nome_trading_plan" id="nome_trading_plan"  style="font-size: 12px;">
                    <option value="">-- Selecione a Trading Plan --</option>
                  @foreach($pegarplan as $plan)
                    <option value={{$plan->nome_trading_plan}}>{{$plan->nome_trading_plan}}</option>
                  @endforeach
                  </select>
                </div>

                <input type="hidden" class="form-control" name="email" value={{ Auth::user()->email }} placeholder="email">
              </div>
              <button type="submit" class="btn btn-primary" style="margin-top: 30px">Editar Operação</button>
            </div>

          </div>
        </form>

          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listagem das Operações</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body col-md-12">
                <table id="table_operacoes" class="table-fixed table-bordered table-dark table-striped table-hover">
                  <thead>
                  <tr>
                    <th>Ativo</th>
                    <th>Abertura</th>
                    <th>Fechamento</th>
                    <th>Tempo</th>
                    <th>Qtd</th>
                    <th>Lado</th>
                    <th>Preco Compra</th>
                    <th>Preco Venda</th>
                    <th>Mep</th>
                    <th>Men</th>
                    <th>Médio</th>
                    <th>Resultado (R$)</th>
                    <th>Resultado (%)</th>
                    <th>Total</th>
                    <th>Nome Estratégia</th>
                    <th>Nome Trading Plan</th>
                  </tr>
                  </thead>
                  <tbody>

                    <style>
                      .edit {


                        }
                      .delete {

                        }
                      .actions {
                        padding:4px;
                        color:#fff;
                        text-decoration:none;
                        font-size:1em;

                        }
                    </style>


                  <tr>
                    <td>{{$operacao->ativo_operacao}}</td>
                    <td>{{date('d/m/Y', strtotime($operacao->data_abertura_operacao)) }}</td>
                    <td>{{date('d/m/Y', strtotime($operacao->data_fechamento_operacao)) }}</td>
                    <td>{{$operacao->tempo_operacao}}</td>
                    <td>{{$operacao->qtd_operacao}}</td>
                    <td>{{$operacao->lado_operacao}}</td>
                    <td>{{$operacao->preco_compra_operacao}}</td>
                    <td>{{$operacao->preco_venda_operacao}}</td>
                    <td>{{$operacao->mep_operacao}}</td>
                    <td>{{$operacao->men_operacao}}</td>
                    <td>{{$operacao->medio_operacao}}</td>
                    <td>{{$operacao->resultado_operacao}}</td>
                    <td>{{$operacao->resultado_porcetangem}}</td>
                    <td>{{$operacao->Total}}</td>
                    <td>{{$operacao->nome_estrategia}}</td>
                    <td>{{$operacao->nome_trading_plan}}</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        </div>
    </body>
  @endsection

