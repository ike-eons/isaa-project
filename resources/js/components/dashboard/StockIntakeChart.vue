<template>
    <div>
      <!-- <h2>Line Chart Graph</h2> -->
        <!-- <line-chart :data="chartData"></line-chart> -->
        <line-chart />
        
        <!-- <horinzontal-chart /> -->
    </div>
</template>

<script>

import LineChart from '../analytics/LineChart.vue'
import HorinzontalChart from '../analytics/HorinzontalChart.vue'

export default {
  components:{
    LineChart,
    HorinzontalChart
  },
    data(){
      return{
        
      }
     
    }
}
</script>

<style>

</style>