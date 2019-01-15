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
use Yii;
use yii\helpers\Html;
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render("display", ['model' => $model]);
        } else {
            return $this->render('forecast', ['model' => $model]);

        }
    }

    public function actionDisplay()
    {
        $model = new Weather();
        return $this->render("display", ['model' => $model]);
    }

    static public function getData()
    {
        $model = new Weather();
        $host = "https://ali-weather.showapi.com";
        $path = "/area-to-weather";
        $method = "GET";
        $appcode = "371c81cea7784fcfac15d67ccb9dde0a";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "area=大连";
//        $querys = "area=" . HTML::encode($model->area);
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        $response = curl_exec($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $weather = json_decode($body);
        return $weather;
    }
}