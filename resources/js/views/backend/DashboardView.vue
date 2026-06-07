<template>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title">
            <h5>Dashboard</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-xl-4">
      <div class="card" id="Today Sales">
        <div class="card-body">
          <h6 class="mb-4">Продажи за сегодня <sup>{{ todayOrdersCount }}</sup></h6>
          <div class="row d-flex align-items-center">
            <div class="col-9">
              <h3 class="f-w-300 d-flex align-items-center m-b-0">
                <i class="feather icon-arrow-up text-success f-30 m-r-10" v-if="todayOrdersPercentage >= 0"></i>
                <i class="feather icon-arrow-down text-danger f-30 m-r-10" v-else></i>
                Ꝑ {{ todayOrdersTotal.toFixed(2) }}
              </h3>
            </div>
            <div class="col-3 text-end">
              <p class="m-b-0">{{ todayOrdersPercentage }}%</p>
            </div>
          </div>
          <div class="progress m-t-30" style="height: 7px">
            <div
              class="progress-bar"
              :class="todayOrdersPercentage < 0 ? 'bg-brand-color-2' : 'bg-brand-color-1'"
              role="progressbar"
              :style="`width:${Math.abs(todayOrdersPercentage)}%`"
              :ariaValuenow="Math.abs(todayOrdersPercentage)"
              aria-valuemin="0"
              aria-valuemax="100">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card" id="MonthlySales">
        <div class="card-body">
          <h6 class="mb-4">Продажи за месяц <sup>{{ currentMonthOrdersCount }}</sup></h6>
          <div class="row d-flex align-items-center">
            <div class="col-9">
              <h3 class="f-w-300 d-flex align-items-center m-b-0">
                <i class="feather icon-arrow-up text-success f-30 m-r-10" v-if="currentMonthOrdersPercentage >= 0"></i>
                <i class="feather icon-arrow-down text-danger f-30 m-r-10" v-else></i>
                Ꝑ {{ currentMonthOrdersSum.toFixed(2) }}
              </h3>
            </div>
            <div class="col-3 text-end">
              <p class="m-b-0">{{ currentMonthOrdersPercentage }}%</p>
            </div>
          </div>
          <div class="progress m-t-30" style="height: 7px">
            <div
              class="progress-bar"
              :class="currentMonthOrdersPercentage < 0 ? 'bg-brand-color-2' : 'bg-brand-color-1'"
              role="progressbar"
              :style="`width:${Math.abs(currentMonthOrdersPercentage)}%`"
              :ariaValuenow="Math.abs(currentMonthOrdersPercentage)"
              aria-valuemin="0"
              aria-valuemax="100">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-xl-4">
      <div class="card" id="YearlySales">
        <div class="card-body">
          <h6 class="mb-4">Продажи за год <sup>{{ currentYearOrdersCount }}</sup></h6>
          <div class="row d-flex align-items-center">
            <div class="col-9">
              <h3 class="f-w-300 d-flex align-items-center m-b-0">
                <i class="feather icon-arrow-up text-success f-30 m-r-10" v-if="currentYearOrdersPercentage >= 0"></i>
                <i class="feather icon-arrow-down text-danger f-30 m-r-10" v-else></i>
                Ꝑ {{ currentYearOrdersSum.toFixed(2) }}
              </h3>
            </div>
            <div class="col-3 text-end">
              <p class="m-b-0">{{ currentYearOrdersPercentage }}%</p>
            </div>
          </div>
          <div class="progress m-t-30" style="height: 7px">
            <div
              class="progress-bar"
              :class="currentYearOrdersPercentage < 0 ? 'bg-brand-color-2' : 'bg-brand-color-1'"
              role="progressbar"
              :style="`width:${Math.abs(currentYearOrdersPercentage)}%`"
              :ariaValuenow="Math.abs(currentYearOrdersPercentage)"
              aria-valuemin="0"
              aria-valuemax="100">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 col-md-6">
      <div class="card">
        <div class="card-header">
          <h5>Users From United States</h5>
        </div>
        <div class="card-body">
          <div id="world-low" style="height: 450px"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6">
      <div class="card bg-primary">
        <div class="card-header border-0">
          <h5 class="text-white">Earnings</h5>
        </div>
        <div class="card-body" style="padding: 0 25px">
          <div class="earning-text mb-0">
            <h3 class="mb-2 text-white f-w-300">${{ totalEarnings }} <i class="feather icon-arrow-up teal accent-3"></i></h3>
            <span class="text-uppercase text-white d-block">Total Earnings</span>
          </div>
          <div id="Widget-line-chart" class="WidgetlineChart2 ChartShadow" style="height: 180px"></div>
        </div>
      </div>
      <div class="card">
        <div class="card-body border-bottom">
          <div class="row d-flex align-items-center">
            <div class="col-auto">
              <i class="feather icon-zap f-30 text-success"></i>
            </div>
            <div class="col">
              <h3 class="f-w-300">235</h3>
              <span class="d-block text-uppercase">TOTAL IDEAS</span>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row d-flex align-items-center">
            <div class="col-auto">
              <i class="feather icon-map-pin f-30 text-primary"></i>
            </div>
            <div class="col">
              <h3 class="f-w-300">26</h3>
              <span class="d-block text-uppercase">TOTAL LOCATIONS</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ statistics year chart ] end -->

    <!-- [social-media section] start -->


    <!-- [ rating list ] starts-->
    <div class="col-xl-4 col-md-6">
      <div class="card user-list">
        <div class="card-header">
          <h5>Стоп лист</h5>
        </div>
        <div class="card-body">
          <div class="row align-items-center justify-content-center m-b-20">
            <div class="col-6">
              <h2 class="f-w-300 d-flex align-items-center float-start m-0"
                >4.7 <i class="fas fa-star f-10 m-l-10 text-warning"></i
              ></h2>
            </div>
            <div class="col-6">
              <h6 class="d-flex align-items-center float-end m-0">0.4 <i class="fas fa-caret-up text-success f-22 m-l-10"></i></h6>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <h6 class="align-items-center float-start"><i class="fas fa-star f-10 m-r-10 text-warning"></i>5</h6>
              <h6 class="align-items-center float-end">384</h6>
              <div class="progress m-t-30 m-b-20" style="height: 6px">
                <div
                  class="progress-bar bg-brand-color-1"
                  role="progressbar"
                  style="width: 70%"
                  aria-valuenow="70"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <div class="col-xl-12">
              <h6 class="align-items-center float-start"><i class="fas fa-star f-10 m-r-10 text-warning"></i>4</h6>
              <h6 class="align-items-center float-end">145</h6>
              <div class="progress m-t-30 m-b-20" style="height: 6px">
                <div
                  class="progress-bar bg-brand-color-1"
                  role="progressbar"
                  style="width: 35%"
                  aria-valuenow="35"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <div class="col-xl-12">
              <h6 class="align-items-center float-start"><i class="fas fa-star f-10 m-r-10 text-warning"></i>3</h6>
              <h6 class="align-items-center float-end">24</h6>
              <div class="progress m-t-30 m-b-20" style="height: 6px">
                <div
                  class="progress-bar bg-brand-color-1"
                  role="progressbar"
                  style="width: 25%"
                  aria-valuenow="25"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <div class="col-xl-12">
              <h6 class="align-items-center float-start"><i class="fas fa-star f-10 m-r-10 text-warning"></i>2</h6>
              <h6 class="align-items-center float-end">1</h6>
              <div class="progress m-t-30 m-b-20" style="height: 6px">
                <div
                  class="progress-bar bg-brand-color-1"
                  role="progressbar"
                  style="width: 10%"
                  aria-valuenow="10"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <div class="col-xl-12">
              <h6 class="align-items-center float-start"><i class="fas fa-star f-10 m-r-10 text-warning"></i>1</h6>
              <h6 class="align-items-center float-end">0</h6>
              <div class="progress m-t-30 m-b-20" style="height: 6px">
                <div
                  class="progress-bar"
                  role="progressbar"
                  style="width: 0"
                  aria-valuenow="0"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ rating list ] end -->

    <!-- [ Recent Users ] start -->
    <div class="col-xl-8 col-md-6">
      <div class="card Recent-Users" id="RecentUsers">
        <div class="card-header">
          <h5>Последние покупатели <sup>{{ recentCustomers.length }}</sup></h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr v-for="customer in recentCustomers" :key="customer.id">
                  <td>
                    <h6 class="mb-1">{{ customer.name }}</h6>
                    <p class="m-0">{{ customer.phone }}</p>
                  </td>
                  <td>
                    <h6 class="text-muted">
                      <i class="fas fa-circle text-success f-10 m-r-15"></i>
                      {{ moment(customer.created_at).format('DD.MM HH:mm') }}
                    </h6>
                  </td>
                  <td class="text-end">
                    <a href="#!" class="badge me-2 bg-brand-color-2 text-white f-12">Reject</a>
                    <a href="#!" class="badge me-2 bg-brand-color-1 text-white f-12">Approve</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Recent Users ] end -->
  </div>
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <button type="button" @click.prevent="refreshChart(chartData)" class="btn btn-secondary">
                  <i class="fa fa-refresh mr-1"></i> Refresh Chart
                </button>
              </div>
            </div>
          </div>
        </div>
        <Chart :chart-data="chartData" @refresh-chart="refreshChart" />
      </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import moment from 'moment'
import Chart from '@/components/Chart.vue'

const todayOrdersCount = ref(0)
const todayOrdersTotal = ref(0)
const todayOrdersPercentage = ref(0)

const currentMonthOrdersCount = ref(0)
const currentMonthOrdersSum = ref(0)
const currentMonthOrdersPercentage = ref(0)

const currentYearOrdersCount = ref(0)
const currentYearOrdersSum = ref(0)
const currentYearOrdersPercentage = ref(0)

const totalEarnings = ref(0)

const recentCustomers = ref([])

const getOrdersCount = () => {
  fetch('/api/backend/stats/orders').then(response => response.json()).then(data => {
    if(data.success) {
      todayOrdersCount.value = data.orders.todayCount
      todayOrdersTotal.value = data.orders.todayTotal
      todayOrdersPercentage.value = calculateProfitDifference(todayOrdersTotal.value, data.orders.yesterdayTotal)
      currentMonthOrdersCount.value = data.orders.thisMonthCount
      currentMonthOrdersSum.value = data.orders.thisMonthTotal
      currentMonthOrdersPercentage.value = calculateProfitDifference(currentMonthOrdersSum.value, data.orders.lastMonthTotal)
      currentYearOrdersCount.value = data.orders.thisYearCount
      currentYearOrdersSum.value = data.orders.thisYearTotal
      currentYearOrdersPercentage.value = calculateProfitDifference(currentYearOrdersSum.value, data.orders.lastYearTotal)
      totalEarnings.value = currentYearOrdersSum.value
    }
  }).catch(error => {
    console.error('Error fetching orders:', error.message)
  })
}

const getRecentCustomers = () => {
  fetch('/api/backend/stats/customers').then(response => response.json()).then(data => {
    if(data.success) {
      recentCustomers.value = data.customers.recent
    }
  }).catch(error => {
    console.error('Error fetching recent users:', error.message)
  })
}

function calculateProfitDifference(todayProfit, yesterdayProfit) {
  // Проверка на ноль, чтобы избежать деления на ноль
  if (yesterdayProfit === 0) {
    return todayProfit > 0 ? Infinity : 0
  }

  // Расчет процентного изменения
  const difference = ((todayProfit - yesterdayProfit) / yesterdayProfit) * 100

  // Округление до 2 знаков после запятой
  return parseFloat(difference.toFixed(2))
}

const chartData = ref({
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  datasets: [
    {
      label: 'My First dataset',
      backgroundColor: '#42A5F5',
      data: [40, 20, 12, 39, 10, 40, 39]
    },
    {
      label: 'My Second dataset',
      backgroundColor: '#FFA726',
      data: [20, 10, 40, 12, 39, 10, 40]
    }
  ]
})
const refreshChart = (chartData) => {
  console.log('refreshChart', chartData)
  chartData.datasets[0].data = [40, 20, 12, 39, 10, 40, 39]
  chartData.datasets[1].data = [20, 10, 40, 12, 39, 10, 40]
}

onMounted(() => {
  getOrdersCount(),
  getRecentCustomers()
})
</script>
