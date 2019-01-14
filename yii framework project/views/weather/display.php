<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 16:05
 */
use \app\controllers\WeatherController;
?>
<head>
    <title>
        Display information
    </title>
</head>
<?php
	echo WeatherController::getData();
?>