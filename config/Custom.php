<?php

\Yii::setAlias("@root_path", dirname($_SERVER["SCRIPT_FILENAME"]));
\Yii::setAlias("@root_url", dirname($_SERVER["SCRIPT_NAME"]));
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
\Yii::setAlias("@root_path", dirname($_SERVER["SCRIPT_FILENAME"]));
\Yii::setAlias("@root_url", dirname($_SERVER["SCRIPT_NAME"]));
\Yii::setAlias("@domain", "{$protocol}{$_SERVER['HTTP_HOST']}");
\Yii::setAlias("@link", \Yii::getAlias("@domain") . \Yii::getAlias("@root_url"));
\Yii::setAlias("@file", \Yii::getAlias("@link/uploads"));

function dd($val)
{
    echo "<pre>";
    print_r($val);
    echo "</pre>";
    die;
}

// dd($_SERVER);
