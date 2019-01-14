<?php
/**
 * Created alt=" " by PhpStorm.
 * User: Yuchen Yao
 * Date: 2019/1/9
 * Time: 11:59
 */

/*
 * https://www.cnblogs.com/open88/p/7343983.html
 * 数据的调用参考阿里云
 */
namespace app\controllers;

use app\models\Weather;
use yii\web\Controller;

header('Content-type:text/html; charset=utf-8');

class WeatherController extends Controller
{
    /*
     * str_ireplace: repleace the whole search part(no case sensitive) in $contents to replace part.
       $contents = str_ireplace('<?xml version ="1.0"?>', "<?xml version =\"1.0\"?> \n", $contents);

       filemtime: return the last modified time
       $fileTime = filemtime(self::$responseXML);

       file_put_contents ( string $filename , mixed $data [, int $flags = 0 [, resource $context ]] )
     * filename:Path to the file where to write the data
     * data: the data to write

     */
    public function actionForecast()
    {
        $model = new Weather();
        return $this->render("forecast", ['model' => $model]);

    }
    public function actionDisplay(){
        return $this->render("display");
    }
    static public function getData()
    {
        $host = "https://ali-weather.showapi.com";
        $path = "/area-to-weather";
        $method = "GET";
        $appcode = "371c81cea7784fcfac15d67ccb9dde0a";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "area=%E4%B8%BD%E6%B1%9F";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        $response = curl_exec($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headers        = substr($response, 0, $header_size);
        $body    = substr($response, $header_size);
        $weather=json_decode($body);
        echo  "<img src=".$weather->showapi_res_body->f1->day_weather_pic." /><br>";
        echo  "城市：  ".$weather->showapi_res_body->cityInfo->c5."<br/>";
        echo  "白天天气：  ".$weather->showapi_res_body->f1->day_weather."<br/>";
        echo  "晚上天气：  ".$weather->showapi_res_body->f1->night_weather."<br/>";
        echo  "最低温度：  ".$weather->showapi_res_body->f1->night_air_temperature."<br/>";
        echo  "最高温度：  ".$weather->showapi_res_body->f1->day_air_temperature."<br/>";
        echo  "PM2.5：  ".$weather->showapi_res_body->now->aqiDetail->pm2_5." ".$weather->showapi_res_body->now->aqiDetail->quality."<br/>";
    }
}