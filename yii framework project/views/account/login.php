<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 14:45
 */

use yii\helpers\html;
use yii\bootstrap\ActiveForm;


$this->title = 'Sign in';
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

<?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('app', 'Username or Email')]); ?>
<?= $form->field($model, 'password')->passwordInput(); ?>
<?= $form->field($model, 'rememberMe')->checkbox([
    'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
]) ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= HTML::submitButton('Sign in', ['class' => 'btn btn-primary']) ?>
        <p>
            Don't have account? <a href="/index.php?r=account/register">Sign up</a>&emsp;
            <a href ="/index.php?r=account/seekpass">Forget password?</a>
            <a href ="/index.php?r=account/changepass">Forget password?</a>
        </p>

    </div>
</div>
<?php ActiveForm::end() ?>
</body>