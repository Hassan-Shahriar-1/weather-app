<template>
    <div>
        <div class="row">
                <div class="col-6">
                    <p class="text-left">Temperature (Last24 hours)</p>
                </div>
                <div class="col-6">
                        <p class="text-right">{{ currentDate }}</p>
                    </div>
         
            <Line id="line-chart" :options="chartOptions" :data="chartData" />
            </div>

    </div>
</template>

<script>
import { Line  } from 'vue-chartjs'

import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    CategoryScale,
    PointElement
} from 'chart.js'

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    CategoryScale,
    PointElement
)


export default {
  props: {
        temperatureData: {
            type :Array,
            required:true
        },
    },
     components: { Line },
    
   
    data() {
        return {
            currentDate: new Date().toLocaleDateString(),
            chartData: {
                labels: ['00', '02', '04', '06', '08', '10', '12', '14', '16', '18', '20', '22', '24'],
                datasets: [{ 
                    label: 'Temparature last 24 hours',
                    data: this.temperatureData,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            chartOptions: {
                 responsive: true
               
            }
        }
    },
    methods: {
            updateChart() {
                this.chartData.datasets[0].data = this.temperatureData;
                //this.renderChart(this.chartData, this.chartOptions);
            }
    },
    watch: {
        temperatureData: {
            handler(newValue, oldValue) {
                if (newValue !== oldValue) {
                    this.updateChart();
                }
            },
            immediate: true
        }
    }
    
};
</script>
