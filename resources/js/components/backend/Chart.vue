<template>
  <div class="container-fluid">
    <button class="btn btn-primary" @click.prevent="$emit('refreshChart', chartData)">Refresh Chart</button>
    <canvas id="myChart"></canvas>
  </div>
</template>
<script setup>

const { chartData, index } = defineProps(['chartData', 'index'])
const emit = defineEmits(['refreshChart'])
import { onMounted } from 'vue'
import Chart from 'chart.js/auto'
onMounted(() => {

  //emit('refreshChart', chartData)

  const ctx = document.getElementById('myChart')
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: chartData,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top'
        },
        title: {
          display: true,
          text: 'Chart.js Bar Chart'
        }
      }
    }
  })

  /*   // Refresh chart when data changes
    watch(() => chartData, (newData) => {
      myChart.data = newData
      myChart.update()
    })

    // Refresh chart when index changes
    watch(() => index, (newIndex) => {
      myChart.data = chartData
      myChart.update()
    })

  */

})

</script>
