<template>
    <div>
        <h1>Dashboard</h1>
        <p>dfgdhgohsdoihosdihoidhfgopidhgfopih</p>
        <line-chart-component :data="chartData" :options="chartOptions" />
        </div>

</template>

<script>
import LineChartComponent from './LineChartComponent.vue';

export default {
    components: {
        LineChartComponent,
    }
   
};
</script>
