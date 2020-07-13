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
                  <h1>Cadastrar Operações</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Operações</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
        <div class="card">
          <div class="container card-body col-md-12 ">
              <!-- Table -->
              <div class="row card-header">
                <div class="col ">
                    <div class="painel shadow col-md-12">
                      <h2><a href="{{ url("/operacoes.xlsx") }}" class="btn btn-primary" style="margin-top: 10px">Baixar Planilha Modelo </a></h2>
                        <form action="{{ route('ImportarOperacoes.save') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <input id="operacoes" type="file" class="form-control" name="operacoes" required>
                            <br>
                            <button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Cadastrar </button>

                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>

          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listagem das Operações</h3>
              </div>


              <!-- /.card-header -->
              <div class="card-body col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form class="panel badege-pill" >
                        @csrf
                            <input type="text" name="Ativo" id="filtro_ativo" placeholder="Ativo" value="{{ old ('capital_aloc_corr') }}">
                            <select name="Estretegia">
                                <option value="">-- Selecione a Estratégia --</option>
                                 @foreach($pegarid as $estrategia)
                                   <option value={{$estrategia->nome_estrategia}}>{{$estrategia->nome_estrategia}}</option>
                                 @endforeach
                            </select>
                            <select name="Trading_Plan">
                                <option value="">-- Selecione o Trading Plan --</option>
                                @foreach($pegarplan as $plan)
                                <option value={{$plan->nome_trading_plan}}>{{$plan->nome_trading_plan}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary badge-pill">Filtrar</button>
                        </form>
                    </div>
                </div>
            </br>
                <div style="float:left;">
                @if(@isset($dataform))
                    {{ $operacoes->appends($dataform)->links() }}
                @else
                    {{ $operacoes->links() }}
                @endif
                </div>

                <table id="table_operacoes" class="table-responsive table-bordered table-dark table-striped table-hover">
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
                    <th>Estratégia</th>
                    <th>Trading Plan</th>
                    <th width="100px">Ações</th>
                  </tr>
                  </thead>
                  <tbody>

                    <style>

                      #delete {
                        padding:4px;
                        color:#fff;
                        text-decoration:none;
                        font-size:1em;

                        }
                      #editar {
                        padding:4px;
                        color:#fff;
                        text-decoration:none;
                        font-size:1em;

                        }
                    </style>
                 @foreach($operacoes as $operacao)

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
                    <td>
                      <a href="{{ route('operacoes.edit', ['id'=> $operacao->id]) }}" class="btn btn-primary" id='editar'>
                        <img src="{{url('bootstrap-icons/icons/pencil.svg')}}"></img>
                      </a>
                      <a href="{{ route('operacoes.delete', ['id'=> $operacao->id]) }}" class="btn btn-danger"  id='delete'>
                        <img src="{{url('bootstrap-icons/icons/trash.svg')}}"></img>
                      </a>

                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
            </br>
                @if(@isset($dataform))
                    {{ $operacoes->appends($dataform)->links() }}
                @else
                    {{ $operacoes->links() }}
                @endif
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        </div>
    </body>
  @endsection

