export default function useRubrics() {

  const getChart = async () => {
    return {
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
    }
  }

  return {
    getChart
  }
}
