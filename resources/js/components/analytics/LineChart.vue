<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  mounted() {
    this.renderChart(
      {
        labels: [
          "29-01-2020",
          "05-02-2020",
          "12-02-2020",
          "19-02-2020",
          "26-02-2020",
          "04-03-2020",
          "11-03-2020",
          "18-03-2020",
          "26-03-2020",
          "02-04-2020",
          "09-04-2020",
          "16-04-2020",
          "23-04-2020"

        ],
        datasets: [
          {
            label: "",
            data: [52334, 50000, 57000, 34000, 47022, 48900, 38020,60456,40789,28017,22600,15540,44987],
            backgroundColor: "transparent",
            borderColor: "rgba(1, 116, 188, 0.50)",
            pointBackgroundColor: "rgba(171, 71, 188, 1)"
          }
        ]
      },
      {
        responsive: true,
        maintainAspectRatio: false,
        title: {
          display: true,
          text: "Weekly stock intake from Distributors"
        }
      }
    );
  }
};
</script>