<template>
    <div>
       <div class="row">
                <div class="col-6">
                    <p class="text-left">Humidity (Last24 hours)</p>
                </div>
                <div class="col-6">
                        <p class="text-right">{{ currentDate }}</p>
                    </div>
        <Bar id="humidity-chart" :options="chartOptions" :data="chartData" />
        </div>
    </div>
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)


export default {
    props: {
        humidityData: {
            type:Array,
            required:true
        }, // Define the prop name
    },
    components: { Bar },

    data() {
        return {
            currentDate: new Date().toLocaleDateString(),
            chartData: {
                labels: ['00', '02', '04', '06', '08', '10', '12', '14', '16','18', '20','22','24'],
                datasets: [{
                    label: 'Humidity last 24 hours',
                    data: this.humidityData ,
                    borderColor: 'rgb(72, 232, 200)',
                    tension: 0.1
                }]
            },
            chartOptions: {
                responsive: true
            }
        }
    }

};
</script>
