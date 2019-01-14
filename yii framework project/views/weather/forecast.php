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
?>
<head>
    <meta charset="utf-8">
    <title>Weather forecast</title>
</head>
<body>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'area')->textInput(['placeholder'=>Yii::t('app','Input area to check the weather information')]); ?>
<div class="form-group">
    <?= HTML::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
<?php $form = ActiveForm::end()?>
</body>



