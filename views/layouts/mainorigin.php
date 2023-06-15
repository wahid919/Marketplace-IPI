<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Setting;
/* @var $this \yii\web\View */
/* @var $content string */

app\assets\AppAsset::register($this);
dmstr\web\AdminLteAsset::register($this);
\app\assets\AdminLtePluginAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
$pluginAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/plugins');
$set = Setting::find()->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <link rel="icon" type="image/png" href=<?= \Yii::$app->request->BaseUrl . '/uploads/setting/' . $set["0"]->logo ?> />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script>
        var baseUrl = "<?= Yii::$app->urlManager->baseUrl ?>";
    </script>
    <?php $this->head() ?>
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            [
                'directoryAsset' => $directoryAsset,
                'pluginAsset' => $pluginAsset,
            ]
        ) ?>

        <?= $this->render(
            'left.php',
            [
                'directoryAsset' => $directoryAsset,
                'pluginAsset' => $pluginAsset,
            ]
        )
        ?>

        <?= $this->render(
            'content.php',
            [
                'content' => $content,
                'directoryAsset' => $directoryAsset,
                'pluginAsset' => $pluginAsset,
            ]
        ) ?>

    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>