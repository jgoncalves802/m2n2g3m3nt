import {Bar} from 'vue-chartjs'
import chartjsPluginAnnotation from "chartjs-plugin-annotation"
import ChartDataLabels from 'chartjs-plugin-datalabels';
Chart.plugins.unregister(ChartDataLabels);
export default{
    extends: Bar,

    props: {
        labels: {
            type: Array,
            require: true,
        },
        datasets: {
            type: Array,
            require: true,
        }
    },
    mounted () {
        this.loadChart()
    },
    methods: {
        loadChart () {
            this.renderChart({
                labels: this.labels,
                datasets: this.datasets,
                }, {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: true,
                        position: "top",
                        fullWidth: true,
                        labels: {
                        boxWidth: 10,
                        fontSize: 14
                        }
                    },
                    scales: {
                        xAxes: [{
                            gridLines : {
                            display : false,
                            }
                        }],
                        yAxes: [{
                            gridLines : {
                            display : false,
                            }
                        }],
                    },
                
                })
        }
    },

    watch: {
        labels () {
            this.loadChart()
        }
    },
}
