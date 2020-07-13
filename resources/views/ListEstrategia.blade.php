@extends('Painel.Layouts.index')

@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      @include('Painel.Layouts.navbbar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Gerenciamento Operacional</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- /.content -->
        <div class="content">
          <div class="container-fluid" id="Cap_locado">
            <div class="row">
              <div class="col-lg-3">
                <div class="card" id="trading_plan">
                  <article class="card-body">
                    <h4 class="icon-users">Estratégia</h4>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-dark d-flex justify-content-between align-items-center">
                        Nome:
                        <div class="badge ">

                            <select  class="badge badge-pill badge-success" name="name_estrategia" id="name_estrategia"  style="font-size: 12px;">
                                <option value="">-- Selecione a Estratégia --</option>
                                @foreach($pegarid as $estrategia)
                                <option data-info='<?= json_encode($estrategia) ?>' value={{ $estrategia->id }}>{{ $estrategia->nome_estrategia }}</option>
                                @endforeach
                          </select>
                        </div>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-dark d-flex justify-content-between align-items-center">
                        Capital Alocado na Corretora:

                        <span class="badge badge-pill badge-light" ></span>

                      </li>
                    </ul>
                    <ul class="list-group" id="capital_inicial">
                      <li class="list-group-item list-group-item-action list-group-item-dark d-flex justify-content-between align-items-center">
                        Capital Inicial:
                        <span class="badge badge-pill badge-light"></span>
                      </li>
                    </ul>
                    </br>
                    <h4 class="icon-users">Análise de Risco</h4>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-dark d-flex justify-content-between align-items-center">
                        Risco x Retorno GAIN:
                        <span class="badge badge-pill badge-light"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-dark d-flex justify-content-between align-items-center">
                        Risco x Retorno LOSS:
                        <span class="badge badge-pill badge-light"></span>
                      </li>
                    </ul>
                    </br>
                    <h4 class="icon-users">Meta Financeira</h4>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-between align-items-center">
                        Diário:
                        <span class="badge badge-pill badge-warning "></span>
                        <span class="badge badge-pill badge-primary"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center">
                          Semanal:
                        <span class="badge badge-pill badge-warning"></span>
                        <span class="badge badge-pill badge-primary"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-success d-flex justify-content-between align-items-center">
                        Mensal:
                        <span class="badge badge-pill badge-warning badge-pill"></span>
                        <span class="badge badge-pill badge-primary badge-pill"></span>
                      </li>
                    </ul>
                    </br>
                    <ul class="list-group">

                      <buttom action="{{route('ListEstrategia.edit')}}" type="submit" class="btn btn-primary" id='editar' method="POST">
                        <img src="{{url('bootstrap-icons/icons/pencil.svg')}}"></img>
                      </buttom>
                       <buttom type"submit" class="btn btn-danger" id='destroy' value="">
                        <img src="{{url('bootstrap-icons/icons/trash.svg')}}"></img>
                      </buttom>

                    </ul>
                  </article>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="card" id="trading_plan">
                  <article class="card-body">
                    <h4 class="icon-users">Meta de Pontos</h4>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-between align-items-center">
                        Diário:
                        <span class="badge badge-pill badge-warning "></span>
                        <span class="badge badge-pill badge-primary"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center">Semanal:
                        <span class="badge badge-pill badge-warning"></span>
                        <span class="badge badge-pill badge-primary"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-success d-flex justify-content-between align-items-center">
                        Mensal:
                        <span class="badge badge-pill badge-warning badge-pill"></span>
                        <span class="badge badge-pill badge-primary badge-pill"></span>
                      </li>
                    </ul>
                    </br>
                    <h4 class="icon-users">Limite Financeiro</h4>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center">
                        Diário:
                        <span class="badge badge-pill badge-danger "></span>
                        <span class="badge badge-pill badge-primary"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-warning d-flex justify-content-between align-items-center">Semanal:
                        <span class="badge badge-pill badge-danger"></span>
                        <span class="badge badge-pill badge-primary"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-danger d-flex justify-content-between align-items-center">
                        Mensal:
                        <span class="badge badge-pill badge-danger badge-pill"></span>
                        <span class="badge badge-pill badge-primary badge-pill"></span>
                      </li>
                    </ul>
                    </br>
                    <h4 class="icon-users">Loss em Pontos</h4>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center">
                        Diário:
                        <span class="badge badge-pill badge-danger "></span>
                        <span class="badge badge-pill badge-primary"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-warning d-flex justify-content-between align-items-center">Semanal:
                        <span class="badge badge-pill badge-danger"></span>
                        <span class="badge badge-pill badge-primary"></span>
                      </li>
                    </ul>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-action list-group-item-danger d-flex justify-content-between align-items-center">
                        Mensal:
                        <span class="badge badge-pill badge-danger badge-pill"></span>
                        <span class="badge badge-pill badge-primary badge-pill"></span>
                      </li>
                    </ul>
                    </br>
                  </article>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card" id="trading_plan">
                  <article class="card-body">
                    <h4 class="icon-home">Passo a Passo</h4>
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
                          <span id="passoapasso" ></span>
                          </li>
                          </ul>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      var select = document.getElementById('name_estrategia');
        select.onchange = function() {
            var id = this.options[this.selectedIndex].dataset.info;
            id = JSON.parse(id);
            console.log(id);
            var list_items = document.querySelectorAll('#Cap_locado span');

            // console.log(typeof list_items);

            list_items[0].innerText = id.capital_aloc_corr;
            list_items[1].innerText = id.capital_dest_op;
            list_items[2].innerText = id.rr_gain;
            list_items[3].innerText = id.rr_loss;
            list_items[4].innerText = id.meta_f_d;
            list_items[6].innerText = id.meta_f_s;
            list_items[8].innerText = id.meta_f_m;
            list_items[10].innerText = id.meta_p_d;
            list_items[12].innerText = id.meta_p_s;
            list_items[14].innerText = id.meta_p_m;
            list_items[16].innerText = id.loss_f_d;
            list_items[18].innerText = id.loss_f_s;
            list_items[20].innerText = id.loss_f_m;
            list_items[22].innerText = id.loss_p_d;
            list_items[24].innerText = id.loss_p_s;
            list_items[26].innerText = id.loss_p_m;
            list_items[28].innerText = id.passo_a_passo;
           // console.log(list_items);

            var edit_item = id.id;
             edit_item[0].value = id.id;
             console.log(edit_item[0].value)


        };
    </script>
  @endsection



