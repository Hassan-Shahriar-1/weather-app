<template>
    <div>
        <div class="row">
            <div class="col-7 mt-5">
                <h4 class="text-center">Weather Report</h4>
                <div class="row text-center">
                    <!-- <div :v-for="(cityData, index) in chartData['latest']"
                    :key="index"> -->
                    <div class="card custom-card col-3 m-4">
                        <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ cityData }}</h5>
                            <p class="card-subtitle">{{ cityCode }} - {{ country }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img :src="weatherIcon" class="weather-icon" alt="Weather Icon" />
                        </div>
                        <div class="text-center">
                            <h2 class="temperature">{{ temperature }}°</h2>
                        </div>
                        </div>
                    </div>
                <!-- </div> -->

                </div>
        </div>

        <div class="col-5">
            
            <div class="col-12"><temparature-chart :data="chartData" :options="chartOptions"></temparature-chart></div>
            <br>
            <div class="col-12"><wind-chart :data="chartData" :options="chartOptions"></wind-chart></div>
            <br>
            <div class="col-12"><humidity-chart :data="chartData" :options="chartOptions" /></div>
        </div>
        </div>
    </div>

</template>

<script>
import HumidityChart from './HumidityChart.vue';
import TemparatureChart from './TemparatureChart.vue';
import WindChart from './WindChartComponent.vue';

export default {
    components: {
        HumidityChart,
        TemparatureChart,
        WindChart
    },
    mounted(){
        this.reportCallApi()
        console.log('after load', this.chartData)
    },
   data() {
        return {
            chartData :[],
            selectedCity : ''
        };
    },
    methods:{
         reportCallApi() {
            axios.get('weather-report?city='.this.selectedCity) // Replace with your actual API route
                .then(response => {
                    
                    if(response.data.status_code == 200){   

                        this.chartData = response.data.data
                        
                    }else{
                        this.chartData = null
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
         },
         changeCity(cityName){
            this.selectedCity = cityName
         }
    }
};

</script>
