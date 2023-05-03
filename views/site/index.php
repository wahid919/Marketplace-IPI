<?php
/* @var $this yii\web\View */
$this->title = 'Dashboard';

use app\components\Tanggal;

//$tableData = array_diff($tableData,$stk);

?>

<html>

<head>

</head>

<body>
  <div class="row">
    <div class="col-xs-12" style="margin-bottom: 20px;">
      <h4 class="text-center">
        Selamat Datang di Dashboard <?= \Yii::$app->user->identity->name; ?>
      </h4>
    </div>
  </div>
  

  

</body>

</html>
