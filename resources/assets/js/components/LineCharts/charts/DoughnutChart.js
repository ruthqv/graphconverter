import { Doughnut, mixins } from 'vue-chartjs'
 
export default {
	extends: Doughnut,
    mixins: [mixins.reactiveProp],
    props: ['chartData', 'options'],
    mounted () {
    	//console.log(this.chartData)
        this.renderChart(this.chartData, this.options)
    },

}