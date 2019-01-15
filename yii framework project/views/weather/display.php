<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 16:05
 */

use \app\controllers\WeatherController;
use yii\helpers\Html;

?>
    <head>
        <title>
            Display information
        </title>
    </head>

<?php
echo "<img src=" . WeatherController::getData()->showapi_res_body->f1->day_weather_pic . " /><br>";
echo "City：  " . WeatherController::getData()->showapi_res_body->cityInfo->c5 . "<br/>";
echo "Day Weather：  " . WeatherController::getData()->showapi_res_body->f1->day_weather . "<br/>";
echo "Night Weather：  " . WeatherController::getData()->showapi_res_body->f1->night_weather . "<br/>";
echo "Lowest temperature：  " . WeatherController::getData()->showapi_res_body->f1->night_air_temperature . "<br/>";
echo "Highest temperature：  " . WeatherController::getData()->showapi_res_body->f1->day_air_temperature . "<br/>";
echo "PM2.5：  " . WeatherController::getData()->showapi_res_body->now->aqiDetail->pm2_5 . " " . WeatherController::getData()->showapi_res_body->now->aqiDetail->quality . "<br/>";
echo "Sun rise and sunset time:" . WeatherController::getData()->showapi_res_body->f1->sun_begin_end . "<br/>";

echo "<img src=" . WeatherController::getData()->showapi_res_body->f2->day_weather_pic . " /><br>";
echo "City：  " . WeatherController::getData()->showapi_res_body->cityInfo->c5 . "<br/>";
echo "Day Weather：  " . WeatherController::getData()->showapi_res_body->f2->day_weather . "<br/>";
echo "Night Weather：  " . WeatherController::getData()->showapi_res_body->f2->night_weather . "<br/>";
echo "Lowest temperature：  " . WeatherController::getData()->showapi_res_body->f2->night_air_temperature . "<br/>";
echo "Highest temperature：  " . WeatherController::getData()->showapi_res_body->f2->day_air_temperature . "<br/>";
//echo "PM2.5：  " . WeatherController::getData()->showapi_res_body->f2->aqiDetail->pm2_5 . " " . WeatherController::getData()->showapi_res_body->f2->aqiDetail->quality . "<br/>";
echo "Sun rise and sunset time:" . WeatherController::getData()->showapi_res_body->f2->sun_begin_end . "<br/>";

echo "<img src=" . WeatherController::getData()->showapi_res_body->f3->day_weather_pic . " /><br>";
echo "City：  " . WeatherController::getData()->showapi_res_body->cityInfo->c5 . "<br/>";
echo "Day Weather：  " . WeatherController::getData()->showapi_res_body->f3->day_weather . "<br/>";
echo "Night Weather：  " . WeatherController::getData()->showapi_res_body->f3->night_weather . "<br/>";
echo "Lowest temperature：  " . WeatherController::getData()->showapi_res_body->f3->night_air_temperature . "<br/>";
echo "Highest temperature：  " . WeatherController::getData()->showapi_res_body->f3->day_air_temperature . "<br/>";
//echo "PM2.5：  " . WeatherController::getData()->showapi_res_body->f3->aqiDetail->pm2_5 . " " . WeatherController::getData()->showapi_res_body->f3->aqiDetail->quality . "<br/>";
echo "Sun rise and sunset time:" . WeatherController::getData()->showapi_res_body->f3->sun_begin_end . "<br/>";
/*
echo "<img src=" . WeatherController::getData()->showapi_res_body->f4->day_weather_pic . " /><br>";
echo "City：  " . WeatherController::getData()->showapi_res_body->cityInfo->c5 . "<br/>";
echo "Day Weather：  " . WeatherController::getData()->showapi_res_body->f4->day_weather . "<br/>";
echo "Night Weather：  " . WeatherController::getData()->showapi_res_body->f4->night_weather . "<br/>";
echo "Lowest temperature：  " . WeatherController::getData()->showapi_res_body->f4->night_air_temperature . "<br/>";
echo "Highest temperature：  " . WeatherController::getData()->showapi_res_body->f4->day_air_temperature . "<br/>";
//echo "PM2.5：  " . WeatherController::getData()->showapi_res_body->f4->aqiDetail->pm2_5 . " " . WeatherController::getData()->showapi_res_body->f4->aqiDetail->quality . "<br/>";
echo "Sun rise and sunset time:" . WeatherController::getData()->showapi_res_body->f4->sun_begin_end . "<br/>";

echo "<img src=" . WeatherController::getData()->showapi_res_body->f5->day_weather_pic . " /><br>";
echo "City：  " . WeatherController::getData()->showapi_res_body->cityInfo->c5 . "<br/>";
echo "Day Weather：  " . WeatherController::getData()->showapi_res_body->f5->day_weather . "<br/>";
echo "Night Weather：  " . WeatherController::getData()->showapi_res_body->f5->night_weather . "<br/>";
echo "Lowest temperature：  " . WeatherController::getData()->showapi_res_body->f5->night_air_temperature . "<br/>";
echo "Highest temperature：  " . WeatherController::getData()->showapi_res_body->f5->day_air_temperature . "<br/>";
//echo "PM2.5：  " . WeatherController::getData()->showapi_res_body->f5->aqiDetail->pm2_5 . " " . WeatherController::getData()->showapi_res_body->f5->aqiDetail->quality . "<br/>";
echo "Sun rise and sunset time:" . WeatherController::getData()->showapi_res_body->f5->sun_begin_end . "<br/>";

echo "<img src=" . WeatherController::getData()->showapi_res_body->f6->day_weather_pic . " /><br>";
echo "City：  " . WeatherController::getData()->showapi_res_body->cityInfo->c5 . "<br/>";
echo "Day Weather：  " . WeatherController::getData()->showapi_res_body->f6->day_weather . "<br/>";
echo "Night Weather：  " . WeatherController::getData()->showapi_res_body->f6->night_weather . "<br/>";
echo "Lowest temperature：  " . WeatherController::getData()->showapi_res_body->f6->night_air_temperature . "<br/>";
echo "Highest temperature：  " . WeatherController::getData()->showapi_res_body->f6->day_air_temperature . "<br/>";
//echo "PM2.5：  " . WeatherController::getData()->showapi_res_body->f6->aqiDetail->pm2_5 . " " . WeatherController::getData()->showapi_res_body->f6->aqiDetail->quality . "<br/>";
echo "Sun rise and sunset time:" . WeatherController::getData()->showapi_res_body->f6->sun_begin_end . "<br/>";

echo "<img src=" . WeatherController::getData()->showapi_res_body->f7->day_weather_pic . " /><br>";
echo "City：  " . WeatherController::getData()->showapi_res_body->cityInfo->c5 . "<br/>";
echo "Day Weather：  " . WeatherController::getData()->showapi_res_body->f7->day_weather . "<br/>";
echo "Night Weather：  " . WeatherController::getData()->showapi_res_body->f7->night_weather . "<br/>";
echo "Lowest temperature：  " . WeatherController::getData()->showapi_res_body->f7->night_air_temperature . "<br/>";
echo "Highest temperature：  " . WeatherController::getData()->showapi_res_body->f7->day_air_temperature . "<br/>";
//echo "PM2.5：  " . WeatherController::getData()->showapi_res_body->f7->aqiDetail->pm2_5 . " " . WeatherController::getData()->showapi_res_body->f7->aqiDetail->quality . "<br/>";
echo "Sun rise and sunset time:" . WeatherController::getData()->showapi_res_body->f7->sun_begin_end . "<br/>";
*/
//$querys = "area=" . HTML::encode($model->area);
//echo $querys;
?>