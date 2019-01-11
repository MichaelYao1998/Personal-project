<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/7
 * Time: 17:23
 */

/* @var $this \yii\web\View */
/* @var $account \app\models\Account[]|array|\yii\db\ActiveRecord[] */
/* @var $pagination \yii\data\Pagination */
use yii\helpers\Html;
use yii\widgets\LinkPager;
//&emsp; => tab
?>
<h1>Account</h1>
<ul>
<?php foreach ($account as $accounts): ?>
    <li>
        <?= Html::encode("{$accounts->username}") ?>: &emsp;
        <?= $accounts->password ?>&emsp;
        <?= $accounts->email ?>&emsp;
        <?=$accounts->password_check?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
