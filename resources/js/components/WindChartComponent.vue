<template>
    <div>
        <div class="row">
            <div class="col-6">
                <p class="text-left">Wind (Last24 hours)</p>
            </div>
            <div class="col-6">
                    <p class="text-right">{{ currentDate }}</p>
                </div>
            <Line id="wind-chart" :options="chartOptions" :data="chartData" />
        </div>
    </div>
</template>

<script>
import { Line } from 'vue-chartjs'

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
        windData: {
            type:Array,
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
                    data: this.windData,
                    fill: false,
                    borderColor: 'red', // Color of the line
                    backgroundColor: 'rgba(255, 255, 255, 0.8)', // Area under the line
                }]
            },
            chartOptions: {
                responsive: true

            }
        }
    }

};
</script>
