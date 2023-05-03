<?php

use app\components\Tanggal;
use richardfan\widget\JSRegister;

$daftartanggal = [];
$total = [];

$daftartanggal2 = [];
$total2 = [];
$a = [];
for ($i = 1; $i <= 12; $i++) {
  // $tgl_terpilih = date("Y-m-d", strtotime(date("Y-m-$i")));
  $flag1 = 1;
  $flag2 = 1;
  $a[$i] = $i;
  $date = date("Y-$i-d");
  $time = strtotime($date);
  $daftartanggal[] = Tanggal::getBulan(date($time), FALSE);
  foreach ($rows_himpunans as  $rows_himpunan) {
    if ($rows_himpunan['bulan'] == $i && $rows_himpunan['tahun'] == date('Y')) {
      $total[(int)$i] = (int)$rows_himpunan['nominal'];
      $flag1 = 0;
    }
  }
  foreach ($rows_penyalurans as  $rows_penyaluran) {
    if ($rows_penyaluran['bulan'] == $i && $rows_penyaluran['tahun'] == date('Y')) {
      $total2[(int)$i] = (int)$rows_penyaluran['nominal'];
      $flag2 = 0;
    }
  }
  if ($flag1) {
    $total[(int)$i] = 0;
  }
  if ($flag2) {
    $total2[(int)$i] = 0;
  }
}
// var_dump($daftartanggal);die;
?>
<style>
  .table-responsive {
    overflow: auto;
  }
</style>
<hr class="mt-0">
<div class="container">
  <div class="row">
    <div class="col-lg-4">
      <div class="row">
        <div class="col-12">
          <h3 class="text-isalam-1 font-weight-bold">Total Keseluruhan</h3>
        </div>
        <div class="col-lg-12 col-md-6 col-sm-6 col-6">
          <p class="font-weight-bold">Pengimpunan</p>
          <p class="text-isalam-1"><?= \app\components\Angka::toReadableHarga($penghimpunan); ?></p>
        </div>
        <div class="col-lg-12 col-md-6 col-sm-6 col-6">
          <p class="font-weight-bold">Penyaluran</p>
          <p class="text-isalam-1"><?= \app\components\Angka::toReadableHarga($penyaluran); ?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="chart-container">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>
</div>

<?php $this->registerJsFile(\Yii::$app->request->BaseUrl . '/chart/chart.js') ?>
<?php JSRegister::begin(); ?>
<script>
  var ctx = document.getElementById("myChart").getContext("2d");

  var data = {
    labels: <?= json_encode($daftartanggal) ?>,
    datasets: [{
        label: "Pengimpunan Dana",
        backgroundColor: "#fcb233",
        data: <?= json_encode(array_values($total)) ?>,
      },
      {
        label: "Penyaluran Dandiva",
        backgroundColor: "#d07500",
        data: <?= json_encode(array_values($total2)) ?>,
      },
    ]
  };

  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
      barValueSpacing: 20,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: !0,
            userCallback: function(value, index, values) {
              // Convert the number to a string and splite the string every 3 charaters from the end
              value = value.toString();
              value = value.split(/(?=(?:...)*$)/);

              // Convert the array to a string and format the output
              value = value.join('.');
              return ' Rp ' + value;
            }
          }
        }]
      },
      tooltips: {
        mode: 'label',
        label: 'mylabel',
        callbacks: {
          label: function(tooltipItem, data) {
            var value = Number(data.datasets[0].data[tooltipItem.index]);
            var value2 = Number(data.datasets[1].data[tooltipItem.index]);
            value = value.toString();
            value = value.split(/(?=(?:...)*$)/);

            value2 = value2.toString();
            value2 = value2.split(/(?=(?:...)*$)/);

            // Convert the array to a string and format the output
            value = value.join('.');
            value2 = value2.join('.');
            // var hasil = ' Rp ' + value;
            // var hasil2 = ' Rp ' + value2;
            return [' Rp ' + value, ' Rp ' + value2];
          },
        },
      }
    }
  });
</script>
<?php JSRegister::end(); ?>