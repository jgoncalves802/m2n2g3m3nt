import {Bar} from 'vue-chartjs'
import 'chartjs-plugin-annotation';
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
        },
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
                    annotation: {
                        annotations: [{
                            rawTime: 'afterDraw', // overrides annotation.drawTime if set
                            id: 'a-line-1', // optional
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: '500',
                            borderColor: 'black',
                            borderWidth: 2,
                                label: {
                                    backgroundColor: 'yellow',
                                    fontFamily: "sans-serif",
                                    fontSize: 12,
                                    fontStyle: "bold",
                                    fontColor: "rgba(0, 0, 0, 1)",
                                    xPadding: 6,
                                    yPadding: 6,
                                    cornerRadius: 6,
                                    xAdjust: 0,
                                    yAdjust: 0,
                                    enabled: true,
                                    content: "META MENSAL",
                                    rotation: 90
                                    },
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
