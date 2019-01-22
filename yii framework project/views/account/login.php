<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 14:45
 */

use yii\helpers\html;
use yii\bootstrap\ActiveForm;
use \yii\captcha\Captcha;
use app\assets\AppAsset;

$this->title = 'Sign in';
$this->params['breadcrumbs'][] = ['label' => 'registration', 'url' => ['login']];
$this->params['breadcrumbs'][] = $this->title;
//how to import js file: https://www.cnblogs.com/lccjob/p/5714583.html
AppAsset::addScript($this, Yii::$app->request->baseUrl . 'web/JavaScript/function.js');
?>

<head>
    <title><?= HTML::encode($this->title) ?></title>
</head>
<body onload=preFilled()>
<?php $form = ActiveForm::begin([
    'id' => 'Account',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

<?= $form->field($model, 'username')->textInput(['placeholder'=>Yii::t('app','Username or Email'),'id' => 'name']); ?>
<?= $form->field($model, 'password')->passwordInput(['id'=>'password']); ?>
<!-- security code: https://www.yii-china.com/post/detail/12.html-->
<?= $form->field($model, 'verifyCode')->widget(Captcha::class) ?>
<label for="RememberMe"></label><input type="checkbox" name="Remember me" id="RememberMe" onclick=storeInfo()>Remember me<br><br>


<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= HTML::submitButton('Sign in', ['class' => 'btn btn-primary']) ?>
        <p>
            Don't have account? <a href="/index.php?r=account/register">Sign up</a>&emsp;
            <a href="/index.php?r=account/seekpass">Find back password</a>
        </p>

    </div>
</div>
<?php ActiveForm::end() ?>
</body>