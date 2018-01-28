
import { Pie } from 'vue-chartjs'
 
export default {
  extends: Pie,
  mounted () {
    // Overwriting base render method with actual data.
    this.renderChart({
            labels: this.$parent.dataforx.datas,           
            datasets: this.$parent.sheets

    })
  }
}