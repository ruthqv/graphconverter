
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
        
        <LineChart :chartData="chartData"></LineChart>
          <br>Your x value : {{chartData.title}}
          <br>
          <div @click="exportimage" class="btn btn-default">
          <i class="fa fa-download"></i>
          <span class="hidden-xs hidden-sm ml5">Export image as png</span>
          </div>
 
    	  <BarChart :chartData="chartData"></BarChart>
        <RadarChart :chartData="chartData"></RadarChart>       

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

//console.log(data[0])

//set array for get options
var seet = {}
var sheets =[seet]
var y;

for (y = 0; y < finalarraycount; y++) {
   seet = {
      //Data to be represented on x-axis
      label: data[y].title,
      //Data to be represented on y-axis
      data: data[y].datas,
      //beautify graphs options
      backgroundColor: getRandomColor(),
   }
 // console.log(seet)
 sheets.push(seet); 
};


//console.log(finalarray)

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
export default {

  data() {
      return {
        chartData: {
          'title':data[0].title,
          'labels': data[0].datas,
          'datasets': sheets,
        },

        finalarray: finalarray,
        customdatasx: '',
        customdatasy: '',
      	data:data,
      }	
  },

  methods:{
      exportimage: function () {
        let canvas = document.getElementById('line-chart').toDataURL('image/png')
        let link = document.createElement('a')
        link.download = 'image'
        link.href = canvas
        link.click()
      },  	
      selectx: function () {
        for (x = 0; x < finalarray.length; x++) {
          if(data[x].title == this.customdatasx){
            this.chartData ={
              'title' :data[x].title,
              'labels': data[x].datas,
              'datasets': sheets,

             } 
          }
        }
      },  

      selecty: function () {
        console.log(this.customdatasy)
      } 
  },
  components: {
    LineChart,
    BarChart,
    RadarChart,
    //BubbleChart,
    // ScatterChart, 
    // DoughnutChart,
    // PieChart,
    //PolarAreaChart, 
      

  }
}
</script>