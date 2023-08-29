<template>
    <div>
        <h1>Line Chart</h1>
         
            <Line id="line-chart" :options="chartOptions" :data="chartData" />
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
  
     components: { Line },
   
    data() {
        return {
            chartData: {
                labels: ['00', '02', '04', '06', '08', '10', '12', '14', '16', '18', '20', '22', '24'],
                datasets: [{ 
                    label: 'Temparature last 24 hours',
                    data: [10, 20, 3, 4, 25,11,19],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
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
