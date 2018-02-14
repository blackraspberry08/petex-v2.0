// Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
// -- Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Dogs", "Cats"],
    datasets: [{
      data: [3,2],
      backgroundColor: ['#ffc107', '#28a745']
    }],
  },
});

// -- Pie Chart Example
var ctx = document.getElementById("myDoughnutChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Adoptable", "Not Adoptable", "Adopted", "Deceased"],
    datasets: [{
      data: [3,1,0,1],
      backgroundColor: ['#2196F3', '#e53935', '#28a745', '#212121']
    }],
  },
});