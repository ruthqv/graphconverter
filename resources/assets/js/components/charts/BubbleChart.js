
import { Bubble } from 'vue-chartjs'
export default {
  extends: Bubble,
  props:['dataforx'],
   data() {
      return {
         datacollection: {
            //Data to be represented on x-axis
            labels: this.dataforx.datas,           
            datasets: this.datasheets
         },

      }
   },
   mounted() {
   	console.log(this.dataforx)
      //renderChart function renders the chart with the datacollection and options object.
      this.renderChart(this.datacollection)
   },
}