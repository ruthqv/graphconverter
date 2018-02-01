import { Bubble, mixins } from 'vue-chartjs'
 
export default {
  extends: Bubble,
    mixins: [mixins.reactiveProp],
    props: ['chartData', 'options'],
    mounted () {
      //console.log(this.chartData)
        this.renderChart(this.chartData, this.options)
    },

}