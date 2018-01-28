
import { Doughnut } from 'vue-chartjs'
 
export default {
  extends: Doughnut,
  mounted () {
    // Overwriting base render method with actual data.
    this.renderChart({
      labels: this.$parent.datatitles,
      datasets: this.$parent.sheets

    })
  }
}