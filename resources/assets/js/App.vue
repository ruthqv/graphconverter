
<template>
  <div class="container text-center">
    <h1>GRAPHICS CHARTS</h1>

      <div class="row">
        <h3>Select options</h3>

        <div class="col-sm-2">
          <label for="customdatasx">Select x value</label>
           <select class="form-control" v-model="customdatasx" id="customdatasx" @change="selectx">
           <option class="form-control" v-for="title in finalarray" v-bind:value="title">{{title}}</option>
        </select>
        </div>        
        <div class="col-sm-2">
          <label for="customdatasy">Select y value</label>
           <select class="form-control" v-model="customdatasy" id="customdatasy" @change="selecty">
          <option class="form-control" v-for="title in finalarray" v-bind:value="title">{{title}}</option>
        </select>
        </div>

      </div>
        <div class="row">
                <br>Your x value : {{chartData.title}}
                <br>Your y value : {{customdatasy}}
        </div>

      <div class="row">
        
        <LineChart :chartData="chartData" :options="{responsive: true, maintainAspectRatio: true}"
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

//console.log(companies)

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
    if(customx !== data[y].title){      
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
        backgroundColor: getRandomColor(),
      }
}

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }

  var result = [color, ''][Math.floor(Math.random() * 2)]

  return result;
}



import LineChart from './components/charts/LineChart'
import BarChart from './components/charts/BarChart'
import RadarChart from './components/charts/RadarChart'

// import DoughnutChart from './components/charts/DoughnutChart'
// import PieChart from './components/charts/PieChart'
//import PolarAreaChart from './components/charts/PolarAreaChart'
//import BubbleChart from './components/charts/BubbleChart'
// import ScatterChart from './components/charts/ScatterChart'

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

        finalarray: finalarray,
        customdatasx: defaultx.title,
        customdatasy: defaulty.title,
      	data:data,
      }	
  },

  methods:{
	
      selectx: function () {
        if(this.customdatasy !== defaulty.title){
          console.log(this.customdatasx);
            this.selecty()

        }else{
        for (x = 0; x < finalarraycount; x++) {
          if(data[x].title == this.customdatasx){
            this.chartData ={
              'title' :data[x].title,
              'labels': data[x].datas,
              'datasets': getAllSheets(this.customdatasx),
             } 
          }
        }

        }

      },  

      selecty: function () {
      var title;  
      var labels; 
      var xvalue;
      var indexy;

        //first we get title and lables from customdatasx if exist, else we get default datas data[0]... 
          if(this.customdatasx !== defaultx.title){
            xvalue= this.customdatasx
          }else{
            xvalue= defaultx.title
          }

        for (x = 0; x < finalarraycount; x++) {
          if(data[x].title == xvalue){
              title  = data[x].title
              labels = data[x].datas
          }

          if(data[x].title == this.customdatasy ){
              indexy = x
          }
        }
        //now we need mount the sheets with customy data from the options of the sheet:
         this.chartData ={
                  'title' :title,
                  'labels': labels,
                  'datasets':[getCustomSheet(indexy)] 
          }       
          
          console.log(this.chartData)
      } 
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