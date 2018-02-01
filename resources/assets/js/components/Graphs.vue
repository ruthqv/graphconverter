<template>
  <div class="container">
     <div class="row">
        <h3>Select options</h3>
        <div class="col-xs-12">
          
           <button class="btn btn-success"  v-on:click="changeview" v-model="charttype"><label for="">{{charttype}}</label>
        </button>
        </div>  
      </div>
      <hr>
      <div class="row">
          <div class="row" v-if="charttype == 'LineCharts'">
            <LineCharts></LineCharts>
          </div>

          <div class="row" v-if="charttype == 'ExcelList'">
              <ExcelList></ExcelList>      
          </div>
      </div>

  </div>  
</template>
<script>


import ExcelList from './ExcelList/ExcelList.vue'
import LineCharts from './LineCharts/LineCharts.vue'




export default {
name:'Graphs',
  data() {
      return {
        charttype: 'LineCharts',
      } 
  },

  components: {
     ExcelList,
     LineCharts
  

  },
    methods:{ 
      changeview: function(){
        if(this.charttype == 'LineCharts'){
           this.charttype = 'ExcelList'
        }else{
            this.charttype = 'LineCharts'
        }
      },
},
}
</script>