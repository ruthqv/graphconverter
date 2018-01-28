

import { Bar } from 'vue-chartjs'
 
export default {
  extends: Bar,
  mounted () {
    // Overwriting base render method with actual data.
    this.renderChart({
      labels: this.$parent.data[0].datas,
      datasets: this.$parent.sheets

    })
  }
}