<?php
/* @var $this yii\web\View */
$this->title = 'Dashboard';

use dosamigos\highcharts\HighCharts;
use app\components\Tanggal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use yii\web\View;


// Calculate dates
$sebulan = date("Ymd", strtotime("-30 day", strtotime(date("Y-m-d"))));
$kemarin = date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m-d"))));
$today = date("Y-m-d");
$bulan = date("Y-m-");
$lalu = date("m") - 1;
$lalu = date("Y") . "-" . $lalu . "-";

// Get transaction data
$trxToday = 0;
$trxKemarin = 0;
$trxTotal = 0;

$transactions = \app\models\Pesanan::find()
  ->where(['>=', 'created_at', $lalu . "1"])
  ->andWhere(['>=', 'status_id', 3])
  ->all();

foreach ($transactions as $transaction) {
  if ($transaction->created_at == $today) {
    $trxToday += 1;
  } elseif ($transaction->created_at == $kemarin) {
    $trxKemarin += 1;
  }

  $trxTotal += 1;
}

// Get sales data
$salesToday = 0;
$salesKemarin = 0;
$salesTotal = 0;

foreach ($transactions as $transaction) {
  $sales = \app\models\Keranjang::find()
    ->where(['id_transaksi' => $transaction->id])
    ->all();

  foreach ($sales as $sale) {
    if ($transaction->created_at == $today) {
      $salesToday += $sale->jumlah;
    } elseif ($transaction->created_at == $kemarin) {
      $salesKemarin += $sale->jumlah;
    }

    $salesTotal += $sale->jumlah;
  }
}

// Get revenue data
$revenueToday = 0;
$revenueKemarin = 0;
$revenueTotal = 0;

$pembayaranToday = \app\models\Pesanan::find()
  ->where(['DATE(created_at)' => $today])
  ->andWhere(['>=', 'status_id', 2])
  ->all();

$pembayaranKemarin = \app\models\Pesanan::find()
  ->where(['DATE(created_at)' => $kemarin])
  ->andWhere(['>=', 'status_id', 2])
  ->all();

$pembayaranTotal = \app\models\Pesanan::find()
  ->where(['>=', 'created_at', $lalu . "2"])
  ->andWhere(['>=', 'status_id', 2])
  ->all();

foreach ($pembayaranToday as $pembayaran) {
  $revenueToday += $pembayaran->nominal;
}

foreach ($pembayaranKemarin as $pembayaran) {
  $revenueKemarin += $pembayaran->nominal;
}

foreach ($pembayaranTotal as $pembayaran) {
  $revenueTotal += $pembayaran->nominal;
}

// Prepare graph data
$graphtgl = [];
$pcs = [];
$nota = [];

for ($i = 0; $i < 20; $i++) {
  $day = 20 - $i;
  $graphtgl[] = date("d/m/Y", strtotime("-" . $day . " day", strtotime(date("Y-m-d"))));
}

for ($i = 0; $i < count($graphtgl); $i++) {
  $transaksi = \app\models\Pesanan::find()
    ->where(['created_at' => date("Y-m-d", strtotime($graphtgl[$i]))])
    ->andWhere(['>=', 'status_id', 2])
    ->count();

  $penjualan = \app\models\Pesanan::find()
    ->where(['created_at' => date("Y-m-d", strtotime($graphtgl[$i]))])
    ->count();

  $graphtgl[$i] = date("d/m", strtotime($graphtgl[$i]));
  $pcs[] = $penjualan;
  $nota[] = $transaksi;
}

$months = [
  1 => 'January',
  2 => 'February',
  3 => 'March',
  4 => 'April',
  5 => 'May',
  6 => 'June',
  7 => 'July',
  8 => 'August',
  9 => 'September',
  10 => 'October',
  11 => 'November',
  12 => 'December',
];

$monthlyData = [];
foreach ($monthlyOrders as $monthlyOrder) {
  $monthlyData[$monthlyOrder['month']] = (int) $monthlyOrder['count'];
}

$chartOptions = [
  'title' => 'Monthly Orders',
  'vAxis' => [
    'title' => 'Number of Orders',
  ],
  'hAxis' => [
    'title' => 'Month',
    'ticks' => array_values($months),
  ],
  'legend' => 'none',
  'seriesType' => 'bars',
  'series' => [
    ['color' => '#1b9e77'],
  ],
  'height' => 400,
];

$js = "
  var chartData = google.visualization.arrayToDataTable([
      ['Month', 'Number of Orders'],
      " . implode(',', array_map(function ($month) use ($monthlyData) {
  return "['{$month}', " . ($monthlyData[$month] ?: 0) . "]";
}, array_keys($months))) . "
  ]);

  var chart = new google.visualization.ColumnChart(document.getElementById('monthly-chart'));
  chart.draw(chartData, " . json_encode($chartOptions) . ");

  $('#monthly-chart').on('click', function(e) {
      var selectedItem = chart.getSelection()[0];
      if (selectedItem) {
          var year = " . $selectedYear . ";
          var month = selectedItem.row + 1;
          
          $.ajax({
              url: '" . Yii::$app->urlManager->createUrl(['site/get-weekly-orders']) . "',
              method: 'GET',
              data: {year: year, month: month},
              success: function(response) {
                  var weeklyData = JSON.parse(response);
                  
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'Week');
                  data.addColumn('number', 'Number of Orders');
                  data.addRows(weeklyData.map(function(item) {
                      return [item.week.toString(), item.count];
                  }));
                  
                  chart.draw(data, " . json_encode($chartOptions) . ");
              }
          });
      }
  });
";

$this->registerJsFile('https://www.gstatic.com/charts/loader.js', ['position' => View::POS_HEAD]);
$this->registerJs(new JsExpression("
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  
  function drawChart() {
      " . $js . "
  }
"), View::POS_END);
?>
<html>

<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div class="row">
    <div class="col-xs-12" style="margin-bottom: 20px;">
      <h4 class="text-center">
        Selamat Datang di Dashboard <?= \Yii::$app->user->identity->name; ?>
      </h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Today's Sales</span>
          <span class="info-box-number"><?= $salesToday ?></span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Today's Revenue</span>
          <span class="info-box-number"><?= $revenueToday ?></span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-list-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Today's Transactions</span>
          <span class="info-box-number"><?= $trxToday ?></span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Yesterday's Sales</span>
          <span class="info-box-number"><?= $salesKemarin ?></span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Yesterday's Revenue</span>
          <span class="info-box-number"><?= $revenueKemarin ?></span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-list-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Yesterday's Transactions</span>
          <span class="info-box-number"><?= $trxKemarin ?></span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Sales</span>
          <span class="info-box-number"><?= $salesTotal ?></span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Revenue</span>
          <span class="info-box-number"><?= $revenueTotal ?></span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-list-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Transactions</span>
          <span class="info-box-number"><?= $trxTotal ?></span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Transaction and Sales Graph</h3>
        </div>
        <!-- <div id="chart-container">
          <canvas id="myChart"></canvas>
        </div> -->
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
          <div class="col-md-4">
            <?php $form = ActiveForm::begin(['action' => ['site/index']]); ?>
            <?= Html::dropDownList('year', $selectedYear, array_combine($years, $years), ['class' => 'form-control', 'prompt' => 'Select Year']) ?>
            <br>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div id="monthly-chart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<!-- <script>
  // Mendapatkan referensi ke elemen canvas
  var ctx = document.getElementById('myChart').getContext('2d');

  // Data untuk grafik
  var graphData = {
    labels: <?= json_encode($graphtgl) ?>,
    datasets: [{
        label: 'Transactions',
        data: <?= json_encode($nota) ?>,
        borderColor: 'rgba(255, 99, 132, 1)',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        fill: false
      },
      {
        label: 'Sales',
        data: <?= json_encode($pcs) ?>,
        borderColor: 'rgba(54, 162, 235, 1)',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        fill: false
      }
    ]
  };

  // Konfigurasi grafik
  var chartOptions = {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  };

  // Membuat grafik menggunakan Chart.js
  var myChart = new Chart(ctx, {
    type: 'line',
    data: graphData,
    options: chartOptions
  });
</script> -->