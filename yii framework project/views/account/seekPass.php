<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 15:17
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\Account */
$this->title = 'Update password';
$this->params['breadcrumbs'][] = ['label' => 'registration', 'url' => ['login']];
$this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>
<?php $form = ActiveForm::begin([
    'id' => 'Account',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
<?= $form->field($model, 'username')->textInput(); ?>
<?= $form->field($model, 'password')->passwordInput(); ?>
<?= $form->field($model, 'password_check')->passwordInput() ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= HTML::submitButton('Update password', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php $form = ActiveForm::end() ?>
</body>