<template>
    <div>
      <h2>Line Chart Graph</h2>
        <line-chart :data="chartData"></line-chart>
        <pie-chart :data="[['nokia',150],['sumsung',100]]"></pie-chart>
        <column-chart :data="[['Sun', 32], ['Mon', 46], ['Tue', 28]]"></column-chart>
    </div>
</template>

<script>

export default {
    data(){
      return{
        chartData:{
          '2017-05-07' : 2,
          '2017-05-08' : 8,
          '2017-05-09' : 9,
        }
      }
     
    }
}
</script>

<style>

</style>