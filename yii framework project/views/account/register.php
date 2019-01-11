<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 17:03
 */

use yii\helpers\html;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
$this->title = 'Sign up';
$this->params['breadcrumbs'][] = ['label' => 'registration', 'url' => ['login']];
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
    <title><?= HTML::encode($this->title) ?></title>
</head>
<body>
<?php $form = ActiveForm::begin([
    'id' => 'Account',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
<?= $form->field($model, 'username')->textInput(); ?>
<?= $form->field($model, 'email')->textInput(); ?>
<?= $form->field($model, 'password')->passwordInput(); ?>
<?= $form->field($model, 'password_check')->passwordInput() ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= HTML::submitButton('Sign up', ['class' => 'btn btn-primary']) ?>
        <p>Already have an account? <a href="/index.php?r=account/login">Sign in</a></p>
    </div>
</div>

<?php $form = ActiveForm::end() ?>
</body>