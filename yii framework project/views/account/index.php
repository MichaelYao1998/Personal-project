<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\Pagination;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $pagination yii\widgets\LinkPager */
$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Account', ['create'], ['class' => 'btn btn-success']) ?>&emsp14;&emsp14;
        <?= HTML::a('Download as csv',['download'],['class'=>'btn btn-success'])?>&emsp14;&emsp14;
        <?= HTML::a('Download as pdf',['download-pdf'],['class'=>'btn btn-success'])?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],//serial number starts from 1

            'username',
            'email:email',
            'password',
            'password_check',

            ['class' => 'yii\grid\ActionColumn'],//用于显示一些动作按钮，如每一行的更新，删除操作
        ],
        'pager' => ['activePageCssClass'=>'am-active'],//pagination

    ]); ?>

</div>

