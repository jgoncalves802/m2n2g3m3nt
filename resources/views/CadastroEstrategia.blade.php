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
                <h1>Cadastro Estratégias</h1>
              </div>
                  
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Estratégias</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="{{ route('CadastroEstrategia') }}" method="POST">
            @csrf
        <section class="content">
       
          <div class="container-fluid">
            <div class="card card-nav-tabs">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Estratégia</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="estrategia-tab" data-toggle="tab" href="#estrategia" role="tab" aria-controls="contact" aria-selected="false">Descrição</a>
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
                                    <input type="text" class="form-control" name="nome_estrategia" value="{{ old ('nome_estrategia') }}" placeholder="Nome da Estratégia">
                                  </div>
                                  <div class="form-group">
                                    <label>Capital Alocado na Corretora</label>
                                    <input type="text" class="form-control" name="capital_aloc_corr" value="{{ old ('capital_aloc_corr') }}" placeholder="Valor Disponivel">
                                  </div>

                                </div>
                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Tipo Operacional</label>
                                    <input type="text" class="form-control" name="tipo_oper" value="{{ old ('tipo_oper') }}" placeholder="Price Action / Fluxo / etc...">
                                  </div>
                                  <div class="form-group">
                                    <label>Capital Destinado Trading Plan</label>
                                    <input type="text" class="form-control" name="capital_dest_op" value="{{ old ('capital_dest_op') }}" placeholder="Valor Destinado o Trading Plan.">
                                  </div>
                                </div>
                              </div>
                            <!-- /.card -->
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                          <div class="card-header">
                            <h3 class="card-title">Analise de Risco</h3>
                          </div>

                          <div class="card-body">
                            <form role="form">
                              <div class="row">
                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Risco x Retorno GAIN</label>
                                    <input type="text" class="form-control" name="rr_gain" value="{{ old ('rr_gain') }}" placeholder="Digite Retorno (EX: 3)" required>
                                  </div>
                                </div>

                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Risco x Retorno LOSS</label>
                                    <input type="text" class="form-control" name="rr_loss" value="{{ old ('rr_loss') }}" placeholder="Digite Risco (EX: 1)" required>
                                  </div>
                                </div>

                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- /.row -->
                      <div class="col-md-6">
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 class="card-title">Meta Gain</h3>
                          </div>

                          <div class="card-body">

                              <div class="row">
                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Meta Financeira Diária</label>
                                    <input type="text" class="form-control" name="meta_f_d" value="{{ old ('meta_f_d') }}" placeholder="Valor Desejado (EX: 500,00)" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Meta Financeira Semanal</label>
                                    <input type="text" class="form-control" name="meta_f_s" value="{{ old ('meta_f_s') }}" placeholder="Valor Desejado (EX: 2500,00)" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Meta Financeira Mensal</label>
                                    <input type="text" class="form-control" name="meta_f_m" value="{{ old ('meta_f_m') }}" placeholder="Valor Desejado (EX: 10000,00)" required>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Meta Pontos Diária</label>
                                    <input type="text" class="form-control" name="meta_p_d"  value="{{ old ('meta_p_d') }}" placeholder="Digite o Valor de Pontos (EX: 10)" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Meta Pontos Semanal</label>
                                    <input type="text" class="form-control" name="meta_p_s"  value="{{ old ('meta_p_s') }}" placeholder="Digite o Valor de Pontos (EX: 50)" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Meta Pontos Mensal</label>
                                    <input type="text" class="form-control" name="meta_p_m"  value="{{ old ('meta_p_m') }}" placeholder="Digite o Valor de Pontos (EX: 200)" required>
                                  </div>
                                </div>
                              </div>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="card card-danger">
                          <div class="card-header">
                            <h3 class="card-title">Meta Financeira Loss</h3>
                          </div>

                          <div class="card-body">

                              <div class="row">
                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Loss Financeira Diária</label>
                                    <input type="text" class="form-control" name="loss_f_d" value="{{ old ('loss_f_d') }}" placeholder="Valor Desejado (EX: -100,00)" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Loss Financeira Semanal</label>
                                    <input type="text" class="form-control" name="loss_f_s" value="{{ old ('loss_f_s') }}" placeholder="Valor Desejado (EX: -500,00)" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Loss Financeira Mensal</label>
                                    <input type="text" class="form-control" name="loss_f_m" value="{{ old ('loss_f_m') }}" placeholder="Valor Desejado (EX: -2000,00)" required>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label>Loss Pontos Diária</label>
                                    <input type="text" class="form-control" name="loss_p_d" value="{{ old ('loss_p_d') }}" placeholder="Digite o Valor de Pontos (EX: -5)" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Loss Pontos Semanal</label>
                                    <input type="text" class="form-control" name="loss_p_s" value="{{ old ('loss_p_s') }}" placeholder="Digite o Valor de Pontos (EX: -25)" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Loss Pontos Mensal</label>
                                    <input type="text" class="form-control" name="loss_p_m" value="{{ old ('loss_p_m') }}" placeholder="Digite o Valor de Pontos (EX: -100)" required>
                                  </div>
                                </div>
                              </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="estrategia" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="container-fluid">
                    <div class="row mt-2">
                      <div class="col-md-12">
                        <div class="card card-secondary">
                          <div class="card-header">
                            <h3 class="card-title">Estratégia Passo a Passo</h3>
                          </div>
                          <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label></label>
                                    <textarea class="form-control" name="passo_a_passo" value="{{ old ('passo_a_passo') }}" rows="3" placeholder="Digite passo a passo do Trading Plan Aqui." required></textarea>
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
              <button type="submit" class="btn btn-block my-2 btn-outline-primary">Criar Estratégias</button>
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

