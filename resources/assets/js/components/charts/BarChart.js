

import { Bar, mixins } from 'vue-chartjs'
 
export default {
	extends: Bar,
    mixins: [mixins.reactiveProp],
    props: ['chartData', 'options'],
    mounted () {
    	//console.log(this.chartData)
        this.renderChart(this.chartData, this.options)
    },

}