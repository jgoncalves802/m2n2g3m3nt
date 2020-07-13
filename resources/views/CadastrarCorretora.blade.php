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
                          <!--<h2><a href="{{ url("/") }}" class="btn btn-primary" style="margin-top: 10px">Baixar Planilha Modelo </a></h2>-->
                            <form action="{{ route('ImportarCorretora.save') }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <input id="corretoras" type="file" class="form-control" name="corretoras" required>
                                <br>
                                <button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Cadastrar </button>

                            </form>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
        </div>        
    </body>
  @endsection

