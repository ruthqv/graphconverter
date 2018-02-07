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
           <option class="form-control" v-for="title in finalarray" v-if="title !== '_id'" v-bind:value="title">{{title}}</option>
        </select>
            <br>
            <p>Your 'x' value : {{chartDataLine.title}}</p>

        </div>        
        <div class="col-xs-4">
          <label for="customdatasy">Select y value</label>
           <select class="form-control" v-model="customdatasy" id="customdatasy" @change="selecty">
          <option class="form-control" v-for="title in finalarray" v-if="title !== '_id'" v-bind:value="title">{{title}}</option>
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

import LineChart from './charts/LineChart'
import BarChart from './charts/BarChart'
import RadarChart from './charts/RadarChart'

import DoughnutChart from './charts/DoughnutChart'
import PieChart from './charts/PieChart'
import PolarAreaChart from './charts/PolarAreaChart'

import ExportImage from '../Images/Export.vue'
//console.log(sheets);

export default {
name:'Graphs',
  
  props: ['companies'],

  data() {
      return {

        chartDataLine: {
          'title':'',
          'labels': '',
          'datasets': '',
        },

        chartDataPie: {
          'title':'',
          'labels': '',
          'datasets': '',
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

        customdatasx: '',
        customdatasy: '',
        finalarray: '',
        finalarraycount: '',

        data:'',
        datas:'',
        errors: '',
        defaultx :'',
        defaulty:''



      } 
  },

mounted(){


          for (let [key, value] of Object.entries(this.companies)) {
            if(value !== 'id' && value !=='_id' ){
                var array = value;
            }
          }
          var finalarray = [];

          for (let [keys, values] of Object.entries(array)) {
              if(keys !== 'id' && keys !=='_id' ){

              finalarray.push(keys);
            }
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
          this.datas= datas

          this.data= data
          this.finalarray = finalarray
          this.finalarraycount= finalarraycount


          this.defaultx = {
          'index' : 0,
          'title' : this.data[0].title,
          'datas' :  this.data[0].datas,
          },
          this.defaulty = {
          'index' : 1,  
          'title' : this.data[1].title,
          'datas' :  this.data[1].datas,
          },

          this.customdatasx= this.defaultx.title,
          this.customdatasy= this.defaulty.title,

          this.chartDataLine= {
          'title':this.defaultx.title,
          'labels': this.defaultx.datas,
          'datasets': this.getAllSheets(this.defaultx.title),
        },

          this.chartDataPie= {
          'title':this.defaultx.title,
          'labels': this.defaultx.datas,
          'datasets': [this.getCustomSheet(this.defaulty.index,datas.length)] ,
        } 


},


  methods:{ 
       getAllSheets:function(customx) {
      //set array for default dataset
      var seet = {}
      var sheets =[]
      var y;

        for (y = 0; y < this.finalarraycount; y++) {
          if(customx !== this.data[y].title && (!isNaN(this.data[y].datas[1])) ){      

             seet = this.getCustomSheet(y)
             sheets.push(seet)       

          }
        }

        return sheets
      },

       getCustomSheet:function(i, numtimes = null) {
      var backgroundColor =this.getRandomColor() 
      var borderColor = this.getRandomColor() 

      if(numtimes !== null){
        backgroundColor = [] 
        for(var e = 0; e  < numtimes; e ++){
            var back = this.getRandomColor() 
            backgroundColor.push(back)
        }
      }
           return {
              //Data to be represented on x-axis
              label: this.data[i].title,
              //Data to be represented on y-axis
              data: this.data[i].datas,
              //beautify graphs options
              borderWidth: 2,
              borderJoinStyle: 'bevel',
              cubicInterpolationMode: 'monotone',
              backgroundColor:backgroundColor,
              borderColor:borderColor,
            }
      },

       getRandomColor:function() {
        var o = Math.round, r = Math.random, s = 255;
        return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
      },
      selectx: function () {
        var x
        for (x = 0; x < this.finalarraycount; x++) {
          if(this.data[x].title == this.customdatasx){
            this.chartDataLine ={
              'title' :this.data[x].title,
              'labels': this.data[x].datas,
              'datasets': this.getAllSheets(this.customdatasx),
             } 
          }

        }

      },  

      selecty: function () {
      var title = this.defaultx.title  
      var labels = this.defaultx.datas 
      var xvalue = this.defaultx.title
      var indexy
      var x
        //first we get title and lables from customdatasx if exist, else we get default datas data[0]... 
        if(this.customdatasx !== this.defaultx.title){
            xvalue= this.customdatasx
          }
        for (x = 0; x < this.finalarraycount; x++) {


          if(this.data[x].title == xvalue){
              title  = this.data[x].title
              labels = this.data[x].datas
          }

          if(this.data[x].title == this.customdatasy && (!isNaN(this.data[x].datas[1])) ) {
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
                  'datasets':[this.getCustomSheet(indexy)] 
         }  
     
          
      },    
  },

  // watch: {
  //     'chartDataLine' () {
  //       console.log(this.chartDataLine)
  //       var xval = this.chartDataLine.title
  //       var yval = this.chartDataLine.datasets[0].label 
  //       var title
  //       var labels
  //       var dataset
  //       for (x = 0; x < this.finalarraycount; x++) {          
  //           if(data[x].title == xval){
  //             title  = data[x].title
  //             labels = data[x].datas
  //           }  
  //           if(data[x].title == yval){
  //             yval = x
  //           }        
  //       }

  //       this.chartDataPie ={
  //                 'title' :title,
  //                 'labels': labels,
  //                 'datasets':[this.getCustomSheet(yval, datas.length )] 
  //        } 

  //   }
  // },


  components: {
    ExportImage,
    LineChart,
    BarChart,
    RadarChart,
    DoughnutChart,
    PieChart,
    PolarAreaChart,
  

  },


}
</script>