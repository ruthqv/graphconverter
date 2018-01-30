<template>
  <div class="container">
<!--      <div class="row">
        <h3>Select options</h3>
        <div class="col-xs-4">
          <label for=""> You are seeing {{charttype}} charts</label>
           <button class="btn"  v-on:click="changetotimecharts('timeline')" v-model="charttype">See time
        </button>
        </div>  
  </div> -->
<div class="row">
        <div class="row" v-if="charttype == 'linecharts'">
      <LineCharts></LineCharts>
      </div>

      <div class="row" v-if="charttype == 'timeline'">
      <TimeLine></TimeLine>      
      </div>
</div>

</div>  
</template>
<script>


import TimeLine from './TimeLine'
import LineCharts from './LineCharts'


export default {
name:'Graphs',
  data() {
      return {
        charttype: 'linecharts',
      } 
  },

  components: {
     TimeLine,
     LineCharts
  

  },
    methods:{ 
      changetotimecharts: function(type){
        this.charttype = type

      },
},
}
</script>