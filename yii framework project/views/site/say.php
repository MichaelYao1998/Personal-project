<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/2
 * Time: 17:07
 */
use yii\helpers\Html;
/*
 * <? ?> = <?php ?>
 * <?= ?> = <?php echo ?>
 */
$this->title = 'Hello Page';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= HTML::encode($message);?>
