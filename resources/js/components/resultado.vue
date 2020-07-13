<template>
<div class="container-fluid">
<div class="row justify-content-right">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Gráfico de Resultado</h5>
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
                    <div class="col-md-12">
                        <p class="text-center">
                            <strong>Resultado do periodo</strong>
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
                                <Line-chart
                                    :labels="labels"
                                    :datasets="datasets"
                                ></Line-chart>
                            </div>
                            <!-- /.chart-responsive -->
                            </div>
                        </div>
                        <!-- /.col -->
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



import LineChart from './LineChart'

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
                     label: 'Relatório de Operações',
                     backgroundColor     : 'rgba(75, 192, 192, 0.5)',
                     borderColor         : 'rgba(75, 192, 192, 0.7)',
                     pointRadius          : false,
                     pointColor          : '#3b8bba',
                     pointStrokeColor    : 'rgba(60,141,188,1)',
                     pointHighlightFill  : '#fff',
                     pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [],

              }
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

           axios.get('/Controle_Operacional/public/api/charts_resultado',{params})
                    .then(response => {
                        this.labels = response.data.labels
                        this.datasets[0].data = response.data.values
                        this.totalsumoperacao = response.data.totalsumoperacao[0].total
                        this.melhoroperacao = response.data.melhoroperacao[0].total
                        this.menoroperacao = response.data.menoroperacao[0].total
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
      }
  },
  components: {
      LineChart
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
