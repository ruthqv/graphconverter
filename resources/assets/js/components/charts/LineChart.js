

import { Line } from 'vue-chartjs';


export default {
   extends: Line,
   data() {
      return {
         datacollection: {
            //Data to be represented on x-axis
            labels: this.$parent.data[0].datas,
           
            datasets: this.$parent.sheets
         },
         //Chart.js options that controls the appearance of the chart
         options: {
            scales: {
               yAxes: [{
                  ticks: {
                     beginAtZero: true
                  },
                  gridLines: {
                     display: true
                  }
               }],
               xAxes: [{
                  gridLines: {
                     display: false
                  }
               }]
            },
            legend: {
               display: true
            },
            responsive: true,
            maintainAspectRatio: false
         }
      }
   },
   mounted() {
      //renderChart function renders the chart with the datacollection and options object.
      this.renderChart(this.datacollection, this.options)
   }
}