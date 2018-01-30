import { PolarArea, mixins } from 'vue-chartjs'
 
export default {
	extends: PolarArea,
    mixins: [mixins.reactiveProp],
    props: ['chartData', 'options'],
    mounted () {
    	//console.log(this.chartData)
        this.renderChart(this.chartData, this.options)
    },
	watch: {
	  	'chartData' (to, from) {
	    this.renderChart(this.chartData, this.options)
	  }
	},
}