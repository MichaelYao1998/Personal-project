<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 15:27
 */

/* @var $this \yii\web\View */

use yii\helpers\html;
$this->title = 'welcome';
$this->params['breadcrumbs'][] = ['label' => 'registration', 'url' => ['login']];
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
    <title><?= Html::encode($this->title) ?></title>
</head>
<body>
<div class="label-info">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Congradulaion! Welcome to the new application.</p>
    <ul>
        <li><label>Name</label>:<?= Html::encode($model->username) ?></li>
        <li><label>Password</label>:<?= Html::encode($model->password) ?></li>
    </ul>
</div>
</body>