@extends('Painel.Layouts.index')

@section('content')
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      @include('Painel.Layouts.navbbar')
      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Gráficos</li>
                    </ol>
                    </div>
                </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-3 col-6">
                                <!-- small box -->
                                @foreach($resultado as $result)
                                @if (($result->total) < 0)
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                        <h3>{{$result->total}}</h3>

                                        <p>Resultado</p>
                                        </div>
                                        <div class="icon">
                                        <i class="ion ion-ios-pulse-strong"></i>
                                        </div>
                                        <span class="small-box-footer">Resultado Acumulado (R$)</span>
                                    </div>
                                @else                       
                                <div class="small-box bg-success">
                                        <div class="inner">
                                        <h3>{{$result->total}}</h3>

                                        <p>Resultado</p>
                                        </div>
                                        <div class="icon">
                                        <i class="ion ion-ios-pulse-strong"></i>
                                        </div>
                                        <span class="small-box-footer">Resultado Acumulado (R$)</span>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                            <!-- ./col -->
                        
                        <!-- small box -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                <h3>{{$countoperacoes}}</h3>

                                <p>Operacoes</p>
                                </div>
                                <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{route('CadastrarOperacoes')}}" class="small-box-footer">Novas Operacoes <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-light">
                                <div class="inner">
                                <h3>{{$counttradinplan}}</h3>

                                <p>Tranding Plan</p>
                                </div>
                                <div class="icon">
                                <i class="ion ion-ios-book"></i>
                                </div>
                                <a href="{{route('CadastroTradingPlan')}}" class="small-box-footer">Cadastrar Tranding Plan <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                <h3>{{$countestrategia}}</sup></h3>

                                <p>Estratégias</p>
                                </div>
                                <div class="icon">
                                <i class="ion ion-clipboard"></i>
                                </div>
                                <a href="{{route('CadastroEstrategia')}}" class="small-box-footer">Cadastrar Operacão <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- Main content -->
            <div id="app">
                <link rel="stylesheet" href="{{ asset('css/app.css') }}">
                <section class="content">   
                    <resultado-component id="chart_operacao_resultado"></resultado-component>                 
                    <operacoes-component id="chart_operacao_operacoes"></operacoes-component>
                    <estrategia-component id="chart_operacao_estrategia"></estrategia-component> 
                    <ativo-component id="chart_operacao_ativo"></ativo-component>                                                
                </section>
                <div class="container-fluid">
                    <div class="row justify-content-right">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card" id="trading_plan">
                                    <article class="card-body">
                                        <h4 class="icon-users">Calendário Econômico</h4>
                                        <ul class="list-group">
                                        <iframe src="https://sslecal2.forexprostools.com?columns=exc_flags,exc_currency,exc_importance,exc_actual,exc_forecast,exc_previous&features=datepicker,timezone&countries=110,17,29,25,32,6,37,36,26,5,22,39,14,48,10,35,7,43,38,4,12,72&calType=week&timeZone=12&lang=12" width="100%" height="550" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe>
                                        </ul>
                                    </article>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" id="trading_plan">
                                    <article class="card-body">
                                        <h4 class="icon-users">Gráficos</h4>
                                        <ul class="list-group">
                                        <iframe height="550" width="100%" src="https://ssltvc.forexprostools.com/?pair_ID=2103&height=550&width=900&interval=300&plotStyle=candles&lang_ID=12&timezone_ID=10" style="border: none;"></iframe>
                                    </ul>
                                    </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                 
            </div>
            <!-- /.content -->
        </div>
    </div>
     <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
@endsection


