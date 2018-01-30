<template>
<div>
<div class="row">
          <div class="col-sm-12">
          <div v-if="errors">
          <b-alert show variant="danger" show dismissible>
            {{errors}} <b>&rArr;</b>
          </b-alert>
          </div>
          </div>
          <div class="col-xs-4">
          <label for="customdatasx">Select x value(reload values)</label>
           <select class="form-control" v-model="customdatasx" id="customdatasx" @change="selectx">
           <option class="form-control" v-for="title in finalarray" v-bind:value="title">{{title}}</option>
        </select>
            <br>
            <p>Your 'x' value : {{chartDataLine.title}}</p>

        </div>        
        <div class="col-xs-4">
          <label for="customdatasy">Select y value</label>
           <select class="form-control" v-model="customdatasy" id="customdatasy" @change="selecty">
          <option class="form-control" v-for="title in finalarray" v-bind:value="title">{{title}}</option>
        </select>
          <br>
            <p>Your 'y' value : {{customdatasy}}</p>
        </div>

</div>




      <div class="row">
      <div class="col-sm-12">     
        <h1>LineChart</h1>
        <LineChart :chartData="chartDataLine" :options="chartOptionsLine"></LineChart>
        <ExportImage :idtoexport="'line-chart'"></ExportImage>
        <hr>
      </div> 
      <div class="col-sm-12">        
        <h1>BarChart</h1>
        <BarChart :chartData="chartDataLine" :options="chartOptionsLine"></BarChart>
        <ExportImage :idtoexport="'bar-chart'"></ExportImage>
        <hr>
      </div> 
      <div class="col-sm-12">
        <h1>RadarChart</h1>
        <RadarChart :chartData="chartDataLine" :options="chartOptionsPie"></RadarChart>       
        <ExportImage :idtoexport="'radar-chart'"></ExportImage>
        <hr>
      </div> 
     <div class="col-sm-12">
        <h1>PolarAreaChart</h1>
        <PolarAreaChart :chartData="chartDataPie" :options="chartOptionsPie"></PolarAreaChart>       
        <ExportImage :idtoexport="'polar-chart'"></ExportImage>
        <hr>       
      </div>       
      <div class="col-sm-6">
        <h1>DoughnutChart</h1>
        <DoughnutChart :chartData="chartDataPie" :options="chartOptionsPie" :width="300" :height="500" ></DoughnutChart>       
        <ExportImage :idtoexport="'doughnut-chart'"></ExportImage>
        <hr> 
      </div> 
      <div class="col-sm-6">
        <h1>PieChart</h1>
        <PieChart :chartData="chartDataPie" :options="chartOptionsPie" :width="300" :height="500" ></PieChart>       
        <ExportImage :idtoexport="'pie-chart'"></ExportImage>
        <hr> 
      </div> 
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

function getCustomSheet(i, numtimes = null) {
var backgroundColor =getRandomColor() 
var borderColor = getRandomColor() 

if(numtimes !== null){
  backgroundColor = [] 
  for(var e = 0; e  < numtimes; e ++){
      var back = getRandomColor() 
      backgroundColor.push(back)
  }
}
     return {
        //Data to be represented on x-axis
        label: data[i].title,
        //Data to be represented on y-axis
        data: data[i].datas,
        //beautify graphs options
        borderWidth: 2,
        borderJoinStyle: 'bevel',
        cubicInterpolationMode: 'monotone',
        backgroundColor:backgroundColor,
        borderColor:borderColor,
      }
}

function getRandomColor() {
  var o = Math.round, r = Math.random, s = 255;
  return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
}



import LineChart from '../components/charts/LineChart'
import BarChart from '../components/charts/BarChart'
import RadarChart from '../components/charts/RadarChart'

import DoughnutChart from '../components/charts/DoughnutChart'
import PieChart from '../components/charts/PieChart'
import PolarAreaChart from '../components/charts/PolarAreaChart'

import ExportImage from '../components/images/Export.vue'
//console.log(sheets);

var defaultx = {
'index' : 0,
'title' : data[0].title,
'datas' :  data[0].datas,
}
var defaulty = {
'index' : 1,  
'title' : data[1].title,
'datas' :  data[1].datas,
}

export default {
name:'Graphs',
  data() {
      return {

        chartDataLine: {
          'title':defaultx.title,
          'labels': defaultx.datas,
          'datasets': getAllSheets(defaultx.title),
        },

        chartDataPie: {
          'title':defaultx.title,
          'labels': defaultx.datas,
          'datasets': [getCustomSheet(defaulty.index,datas.length)] ,
        },

        chartOptionsLine:{
          'responsive' : true, 
          'maintainAspectRatio': false,
          hover: {
            animationDuration: 0, // duration of animations when hovering an item
          },
          elements: {
            line: {
                tension: 0, // disables bezier curves
            }
          },
          scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
          }           
        },

        chartOptionsPie:{
          'responsive' : true, 
          'maintainAspectRatio': true,
          hover: {
            animationDuration: 0, // duration of animations when hovering an item
          },
          
        },

        customdatasx: defaultx.title,
        customdatasy: defaulty.title,
        finalarray: finalarray,
        data:data,
        errors: '',
        charttype: 'linear'

      } 
  },

  methods:{ 
      changetotimecharts: function(type){
        this.charttype = type

      },

      selectx: function () {

        for (x = 0; x < finalarraycount; x++) {
          if(data[x].title == this.customdatasx){
            this.chartDataLine ={
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
         this.chartDataLine ={
                  'title' :title,
                  'labels': labels,
                  'datasets':[getCustomSheet(indexy)] 
         }  
     
          
      },    
  },

  watch: {
      'chartDataLine' () {
        console.log(this.chartDataLine)
        var xval = this.chartDataLine.title
        var yval = this.chartDataLine.datasets[0].label 
        var title
        var labels
        var dataset
        for (x = 0; x < finalarraycount; x++) {          
            if(data[x].title == xval){
              title  = data[x].title
              labels = data[x].datas
            }  
            if(data[x].title == yval){
              yval = x
            }        
        }

        this.chartDataPie ={
                  'title' :title,
                  'labels': labels,
                  'datasets':[getCustomSheet(yval, datas.length )] 
         } 

    }
  },


  components: {
    ExportImage,
    LineChart,
    BarChart,
    RadarChart,
    DoughnutChart,
    PieChart,
    PolarAreaChart,
  

  }
}
</script>