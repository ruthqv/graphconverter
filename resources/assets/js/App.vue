
<template>
  <div class="container">
    <h1>Vue-Chart Dinamic Example</h1>
	   <div @click="exportimage" class="btn btn-default">
      <i class="fa fa-download"></i>
      <span class="hidden-xs hidden-sm ml5">Export image as png</span>
    	</div>
	  <LineChart></LineChart>
	  <BarChart></BarChart>
  </div>
</template>
<script>

var companies = window.companies;

for (let [key, value] of Object.entries(companies)) {
      var array = value;
}
    var finalarray = [];

for (let [keys, values] of Object.entries(array)) {
    //console.log(keys);
    finalarray.push(keys);
}

var finalarraycount = finalarray.length

var data = {}
var companiesname = []
var title
var datas = []
var x;
for (x = 0; x <= finalarraycount; x++) {
      companiesname =companies.map(function(key) {
             return key[''+finalarray[x] +''];
         });
         title = finalarray[x]
         datas = companiesname
         data[x] =  {title:title, datas:datas}

};



var seet = {}
var sheets =[seet]
var y;
for (y = 1; y < finalarraycount; y++) {
   seet = {
      //Data to be represented on x-axis
      label: data[y].title,
      //Data to be represented on y-axis
      data: data[y].datas,
      backgroundColor: getRandomColor(),
   }
 // console.log(seet)
 sheets.push(seet); 
};

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

export default {
	data() {
      return {
      	data:data,
      	sheets:sheets,
      }	
  },
  methods:{
      exportimage: function () {
        let canvas = document.getElementById('line-chart').toDataURL('image/png')
        let link = document.createElement('a')
        link.download = 'image'
        link.href = canvas
        link.click()
      }  	
  },
  components: {
    LineChart,
    BarChart,

  }
}
</script>