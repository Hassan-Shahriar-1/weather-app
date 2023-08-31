<template>
    <div>
       <div class="row">
                <div class="col-6">
                    <p class="text-left">Wind (Last24 hours)</p>
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
                labels: ['January', 'February', 'March'],
                datasets: [{ data: [40, 20, 12] }]
            },
            chartOptions: {
                responsive: true
            }
        }
    }

};
</script>
