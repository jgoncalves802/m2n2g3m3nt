@extends('Painel.Layouts.index')

@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
      <!-- Navbar -->
      @include('Painel.Layouts.navbbar')
      <!-- Content Wrapper. Contains page content -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Cadastro Trading Plan</h1>
              </div>

              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Trading Plan</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="{{ route('CadastroTradingPlan.save') }}" method="POST">
            @csrf
        <section class="content">

          <div class="container-fluid">
            <div class="card card-nav-tabs">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Trading Plan</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="container-fluid">
                    <div class="row mt-2">
                      <!--/.col (left) 2->
                      <!-- right column -->
                      <div class="col-md-12">
                        <!-- general form elements disabled -->

                         @include('Painel.Layouts.alerts')


                        <div class="card card-cyan">
                          <div class="card-header">
                            <h3 class="card-title">Dados</h3>
                          </div>

                          <!-- /.card-header -->
                          <div class="card-body">
                              <div class="row">
                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Nome</label>
                                    <input type="hidden" class="form-control" name="email" value={{ Auth::user()->email }} placeholder="email">
                                    <input type="text" class="form-control" name="nome_trading_plan" value="{{ old ('nome_trading_plan') }}" placeholder="Nome do Plano" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Capital Destinado Trading Plan</label>
                                    <input type="text" class="form-control" name="capital_dest_op" value="{{ old ('capital_dest_op') }}" placeholder="Valor Destinado o Trading Plan." required>
                                  </div>

                                </div>
                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Tipo Operacional</label>
                                    <input type="text" class="form-control" name="tipo_oper" value="{{ old ('tipo_oper') }}" placeholder="Price Action / Fluxo / etc..." required>
                                  </div>
                                  <div class="form-group">
                                    <label>Corretora</label>
                                    <select  class="form-control" name="corret" id="corret"  style="font-size: 12px;">
                                      <option value="">-- Selecione uma Corretora --</option>
                                      @foreach($corret as $corretora)
                                      <option value={{ $corretora->name }}>{{ $corretora->name }}</option>
                                      @endforeach
                                    </select>
                                 </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-block my-2 btn-outline-primary">Criar Trading Plan</button>
            </form>
            </div>
            <!-- /.container-fluid -->
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      </form>
    </div>
  </body>
  @endsection
