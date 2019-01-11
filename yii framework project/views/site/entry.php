<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 10:03
 */
use yii\helpers\html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'email'); ?>
<div class="form-group">
    <?= HTML::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
<?php $form = ActiveForm::end(); ?>

