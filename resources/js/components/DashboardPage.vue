<template>
    <div>
        <div class="row">
            <div class="col-7 mt-5">
                <h3 class="text-center">Weather Report</h3>
                <div class="row text-center">
                    <div class="card custom-card col-3 m-4" v-for="(cityData, index) in chartData.latest" :key="index">
                        
                            <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="card-title">{{ cityData.city }}</h4>
                                <p class="card-subtitle">{{ cityData.country }}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <img :src="iconUrl+cityData.icon+'.png'" class="weather-icon" alt="Weather Icon" />
                            </div>
                            <div class="text-center">
                                <h4 class="temperature">{{ cityData.temparature }}°</h4>
                            </div>
                            </div>
                       
                    </div>

                </div>
        </div>

        <div class="col-5">
            
            <div class="col-12"><temparature-chart :temperature-data="this.chartData.dataset" ></temparature-chart></div>
            <br>
            <div class="col-12"><wind-chart :wind-data="[12, 11, 20, 15, 18]" ></wind-chart></div>
            <br>
            <div class="col-12"><humidity-chart :humidity-data="[12, 11, 20, 15, 18]" /></div>
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
    created(){
        this.reportCallApi()
         console.log('after load', this.chartData)
    },
    
   data() {
        return {
            chartData: [],
            selectedCity : 'Abu Dhabi',
            iconUrl: "http://openweathermap.org/img/w/"
        };
    },
    methods:{
         reportCallApi() {
            axios.get('weather-report?city='+this.selectedCity) // Replace with your actual API route
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
