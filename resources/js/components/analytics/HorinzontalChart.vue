<script>
import { HorizontalBar } from 'vue-chartjs'

export default {
  extends: HorizontalBar,
  mounted() {
    this.renderChart(
      {
        labels: [
          "Nido Pillow",
          "Ideal Milk SM",
          "Ideal Milk BG",
          "Carnation TC",
          "Milo Tin",
          "Cerelac Wheat",
          
        ],
        datasets: [
          {
            label: "Purchase History for Each Product",
            backgroundColor: "#f87979",
            data: [2,80, 30, 50, 15, 10]
          }
        ]
      },
      { responsive: true, maintainAspectRatio: false }
    );
  }
};
</script>
