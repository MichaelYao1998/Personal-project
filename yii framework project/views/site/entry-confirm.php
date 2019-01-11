<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 9:56
 */
use yii\helpers\html;
?>
<p> You have entered the following information:</p>
<ul>
    <li><label>Name</label>: <?= HTML::encode($model->name)?></li>
    <li><label>Email</label>: <?= HTML::encode($model->email)?></li>
</ul>
