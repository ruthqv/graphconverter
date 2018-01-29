
<template>
  <div class="container text-center">
    <h1>GRAPHICS CHARTS</h1>
      <hr>
      <div class="row">
        <h3>Select options</h3>
        <div v-if="errors">{{errors}}</div>
        <div class="col-xs-6">
          <label for="customdatasx">Select x value(reload values)</label>
           <select class="form-control" v-model="customdatasx" id="customdatasx" @change="selectx">
           <option class="form-control" v-for="title in finalarray" v-bind:value="title">{{title}}</option>
        </select>
            <br>
            <h1>Your 'x' value : {{chartData.title}}</h1>

        </div>        
        <div class="col-xs-6">
          <label for="customdatasy">Select y value</label>
           <select class="form-control" v-model="customdatasy" id="customdatasy" @change="selecty">
          <option class="form-control" v-for="title in finalarray" v-bind:value="title">{{title}}</option>
        </select>
          <br>
            <h1>Your 'y' value : {{customdatasy}}</h1>
        </div>

      </div>


      <div class="row">
        
        <LineChart :chartData="chartData" :options="chartOptionsLine"
></LineChart>
        <ExportImage :idtoexport="'line-chart'"></ExportImage>
        <hr>

    	  <BarChart :chartData="chartData" :options="{responsive: true, maintainAspectRatio: true}"></BarChart>
        <ExportImage :idtoexport="'bar-chart'"></ExportImage>
        <hr>

        <RadarChart :chartData="chartData" :options="{responsive: true, maintainAspectRatio: true}"></RadarChart>       
        <ExportImage :idtoexport="'radar-chart'"></ExportImage>
        <hr>

        <!-- <BubbleChart></BubbleChart> -->
       
     </div>

  </div>
</template>
<script>

var companies = window.companies;
for (let [key, value] of Object.entries(companies)) {
      var array = value;
}
var finalarray = [];

for (let [keys, values] of Object.entries(array)) {
    finalarray.push(keys);
}

var finalarraycount = finalarray.length

var data = {}
var companiesdata = []
var title
var datas = []
var x;

for (x = 0; x < finalarraycount; x++) {
    companiesdata =companies.map(function(key) {
           return key[''+finalarray[x] +''];
       });
       title = finalarray[x]
       datas = companiesdata
       data[x] =  {title:title, datas:datas}

};

function getAllSheets(customx) {

//set array for default dataset
var seet = {}
var sheets =[]
var y;

  for (y = 0; y < finalarraycount; y++) {
    if(customx !== data[y].title && (!isNaN(data[y].datas[1])) ){      

       seet = getCustomSheet(y)
       sheets.push(seet)       

    }
  }

  return sheets
}

function getCustomSheet(i) {
     return {
        //Data to be represented on x-axis
        label: data[i].title,
        //Data to be represented on y-axis
        data: data[i].datas,
        //beautify graphs options
        backgroundColor:getRandomColor(),
        borderColor:getRandomColor(),
        borderWidth: 1
      }
}

function getRandomColor() {
  var o = Math.round, r = Math.random, s = 255;
  return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
}



import LineChart from './components/charts/LineChart'
import BarChart from './components/charts/BarChart'
import RadarChart from './components/charts/RadarChart'

//import DoughnutChart from './components/charts/DoughnutChart'
//import PieChart from './components/charts/PieChart'
//import PolarAreaChart from './components/charts/PolarAreaChart'
//import BubbleChart from './components/charts/BubbleChart'
//import ScatterChart from './components/charts/ScatterChart'

import ExportImage from './components/images/Export.vue'

//console.log(sheets);

var defaultx = {
'title' : data[0].title,
'datas' :  data[0].datas,
}
var defaulty = {
'title' : data[1].title,
'datas' :  data[1].datas,
}


export default {

  data() {
      return {
        chartData: {
          'title':defaultx.title,
          'labels': defaultx.datas,
          'datasets': getAllSheets(defaultx.title),
        },

        chartOptionsLine:{
          'responsive' : true, 
          'maintainAspectRatio': true,
          scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }           
        },

        customdatasx: defaultx.title,
        customdatasy: defaulty.title,
        finalarray: finalarray,
      	data:data,
        errors: '',
      }	
  },

  methods:{	
      selectx: function () {

        for (x = 0; x < finalarraycount; x++) {
          if(data[x].title == this.customdatasx){
            this.chartData ={
              'title' :data[x].title,
              'labels': data[x].datas,
              'datasets': getAllSheets(this.customdatasx),
             } 
          }

        }

      },  

      selecty: function () {
      var title = defaultx.title  
      var labels = defaultx.datas 
      var xvalue = defaultx.title
      var indexy
        //first we get title and lables from customdatasx if exist, else we get default datas data[0]... 
        if(this.customdatasx !== defaultx.title){
            xvalue= this.customdatasx
          }

        for (x = 0; x < finalarraycount; x++) {
          
          if(data[x].title == xvalue){
              title  = data[x].title
              labels = data[x].datas
          }

          if(data[x].title == this.customdatasy && (!isNaN(data[x].datas[1])) ) {
              indexy = x
          }

        }
        if(indexy == undefined){
          this.errors = 'Please, dont use string values for y'

         } 
        //now we need mount the sheets with customy data from the options of the sheet:
         this.chartData ={
                  'title' :title,
                  'labels': labels,
                  'datasets':[getCustomSheet(indexy)] 
         }  
     
          
      },    
  },

  components: {
    ExportImage,
    LineChart,
    BarChart,
    RadarChart,
    //BubbleChart,
    //ScatterChart, 
    //DoughnutChart,
    //PieChart,
    //PolarAreaChart, 
      

  }
}
</script>