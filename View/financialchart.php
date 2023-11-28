<?php
    include "../Control/billmanagement.php";
    $b = new BillManagement();
    $income=$b->getIncome();
    $expenses=$b->getExpenses();
?>
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="../Assets/CSS Styles/chartclinic.css">
<body>

<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
const xValues = ["Billing","Equipment"];
const yValues = [<?php echo $income ?>,<?php echo $expenses ?>];
const barColors = ["#4F988D","#2B2D42"];
new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{backgroundColor: barColors , data: yValues}]
  },
  options: {
    title: {display: true , text: "Freud Clinic Financial Chart"}
  }
});
</script>
<table>
    <thead>
        <tr>
            <th>Clinic billing income</th>
            <th>Equipment expenses</th>
            <th>Net profit</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $income ?></td>
            <td><?php echo $expenses ?></td>
            <td><?php echo ($income-$expenses) ?></td>
        </tr>
    </tbody>
</table>
</body>
</html>