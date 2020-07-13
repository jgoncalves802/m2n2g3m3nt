<template>
<div class="container-fluid">
<div class="row justify-content-right">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Gráfico de Operações</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <p class="text-center">
                            <strong>Periodo de Operações</strong>
                        </p>
                        <div class="chart">
                        <!-- Gráficos Operações -->
                            <div>
                                <div v-show="loading">
                                    <h3>Carregando Gráfico</h3>
                                </div>
                                <form class="badge badge-primary " name="filtro_chart">
                                        <input type="date" name="data_inicio" id="data_inicio"  value="data_inicio" :key="data_inicio_filter" v-model="data_inicio_filter" @change="loadData" >
                                        <input type="date" name="data_termino" id="data_termino" value="data_termino" :key="data_termino_filter" v-model="data_termino_filter" @change="loadData" >
                                </form>
                                <Bar-chart
                                    :labels="labels"
                                    :datasets="datasets"
                                ></Bar-chart>
                            </div>
                            <!-- /.chart-responsive -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2" id="operacoes">
                            <p class="text-center">
                                <strong>Operações</strong>
                            </p>

                            <div class="progress-group" >
                                Totais
                                <span class="float-right"><b>{{totaloperacao}}</b></span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 100%">100%</div>
                                </div>
                            </div>
                            <!-- /.progress-group -->

                            <div class="progress-group">
                                Positivas
                                <span class="fixed-right">{{operacoespos}} /<b>{{totaloperacao}}</b></span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" :role="progressbar" :style="{width:(avpos)+'%'}">{{avpos}}%</div>
                                </div>
                            </div>
                            <!-- /.progress-group -->

                            <div class="progress-group">
                                Negativas
                                <span class="fixed-right">{{operacoesneg}} / <b>{{totaloperacao}}</b></span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger" :role="progressbar" :style="{width:(avneg)+'%'}">{{avneg}}%</div>
                                </div>
                            </div>

                            <!-- /.progress-group -->
                            <div class="progress-group">
                                Zeradas
                                <span class="fixed-right">{{operacoeszer}} / <b>{{totaloperacao}}</b></span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-dark " :role="progressbar" :style="{width:(avzer)+'%'}">{{avzer}}%</div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                <div v-if="(totalsumoperacao > '0')">
                                    <h5 class="description-header text-success"><i class="fas fa-caret-up"></i>{{ totalsumoperacao | toCurrency }}</h5>
                                </div>
                                <div v-else>
                                    <h5 class="description-header text-danger"><i class="fas fa-caret-down"></i>{{totalsumoperacao | toCurrency }}</h5>
                                </div>

                                <span class="description-text">RESULTADO ACUMULADO</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                <div v-if="(melhoroperacao > '0')">
                                    <h5 class="description-header text-success"><i class="fas fa-caret-up"></i>{{ melhoroperacao | toCurrency  }}</h5>
                                </div>
                                <div v-else>
                                    <h5 class="description-header text-danger"><i class="fas fa-caret-down"></i>{{melhoroperacao | toCurrency }}</h5>
                                </div>

                                <span class="description-text">MAIOR LUCRO EM UMA OPERAÇÃO</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                <div v-if="(menoroperacao > '0')">
                                    <h5 class="description-header text-success"><i class="fas fa-caret-up"></i>{{ menoroperacao | toCurrency }}</h5>
                                </div>
                                <div v-else>
                                    <h5 class="description-header text-danger"><i class="fas fa-caret-down"></i>{{menoroperacao | toCurrency }}</h5>
                                </div>

                                <span class="description-text">MAIOR PREJUIZO EM UMA OPERAÇÃO</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
</template>

<script>
var totaloperacao = new Vue({

  data: {
    totaloperacao: []
  }
});
var operacoespos = new Vue({
 
  data: {
    operacoespos: []
  }
});
var avpos = new Vue({

  data: {
    avpos: []
  }
});
var operacoesneg = new Vue({

  data: {
    operacoesneg: []
  }
});
var avneg = new Vue({

  data: {
    avneg: []
  }
});
var operacoeszer = new Vue({

  data: {
    operacoeszer: []
  }
});
var avzer = new Vue({

  data: {
    avzer: []
  }
});
var totalsumoperacao = new Vue({
 
  data: {
    totalsumoperacao: []
  }
});
var melhoroperacao = new Vue({

  data: {
    melhoroperacao: []
  }
});
var menoroperacao = new Vue({
 
  data: {
    menoroperacao: []
  }
});
Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('pt-br', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 0
    });
    return formatter.format(value);
});



import BarChart from './BarChart'

export default {

    created (){
        this.loadData()

    },



  data () {
      return {
          data_inicio_filter: '2020-01-01',
          data_termino_filter: '2020-12-31',
          loading: false,
          labels: [],
          datasets: [
              {
                     label: 'Operações Positivas',
                     backgroundColor     : '#5cb85c',
                     borderColor         : 'rgba(60,141,188,0.8)',
                     pointRadius          : false,
                     pointColor          : '#3b8bba',
                     pointStrokeColor    : 'rgba(60,141,188,1)',
                     pointHighlightFill  : '#fff',
                     pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [],

              },
              {
                     label: 'Operações Negativas',
                     backgroundColor     : '#f44336',
                     borderColor         : 'rgba(60,141,188,0.8)',
                     pointRadius          : false,
                     pointColor          : '#3b8bba',
                     pointStrokeColor    : 'rgba(60,141,188,1)',
                     pointHighlightFill  : '#fff',
                     pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [],

              },
              {
                     label: 'Operações Zeradas',
                     backgroundColor     : '#263238',
                     borderColor         : 'rgba(60,141,188,0.8)',
                     pointRadius          : false,
                     pointColor          : '#3b8bba',
                     pointStrokeColor    : 'rgba(60,141,188,1)',
                     pointHighlightFill  : '#fff',
                     pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [],

              },
          ]
      }
  },
  methods: {
      loadData (){
          this.loading = true

          const params = {

              data_inicio: this.data_inicio_filter,
              data_termino: this.data_termino_filter,

              }

           axios.get('/Controle_Operacional/public/api/charts_operacoes',{params})
                    .then(response => {
                        this.labels = response.data.labels
                        this.datasets[0].data = response.data.values
                        this.datasets[1].data = response.data.values1
                        this.datasets[2].data = response.data.values2
                        this.totaloperacao = response.data.totaloperacao
                        this.operacoespos = response.data.operacoespos
                        this.avpos = response.data.avpos
                        this.operacoesneg = response.data.operacoesneg
                        this.avneg = response.data.avneg
                        this.operacoeszer = response.data.operacoeszer
                        this.avzer = response.data.avzer
                        this.totalsumoperacao = response.data.totalsumoperacao[0].total
                        this.melhoroperacao = response.data.melhoroperacao[0].total
                        this.menoroperacao = response.data.menoroperacao[0].total
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
      }
  },
  components: {
      BarChart
  }
}
</script>

<style lang="css">
.small {
  max-width: 800px;
  /* max-height: 500px; */
  margin:  50px auto;
}
</style>
