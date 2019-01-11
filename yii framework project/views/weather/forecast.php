<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 12:03
 */

use app\controllers\WeatherController;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
//WeatherController::getXML("Changsha");
?>
<head>
    <meta charset="utf-8">
    <title>Weather forecast</title>
</head>
<body>
<form action="/index.php?r=weather/display.php" method="post">
    <label>Area: </label>&emsp;<input type="text" name="area">
    <input type="submit" name="search">
</form>
</body>



