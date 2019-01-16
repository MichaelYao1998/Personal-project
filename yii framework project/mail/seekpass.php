<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 16:41
 */

namespace app\mail;
use app\models\Account;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
/*<?//= Html::a('Change the password', Url::to('account/changepass')) ?>*/
$model = new Account();
$time=time();
?>

<p>Hello.</p>
<p>The following link is for you to find back your password: </p>
<?php $url = Yii::$app->urlManager->createAbsoluteUrl(['account/changepass','timestamp'=>$time,'user'=>$model->username]);?>
<p><a href="<?php echo $url; ?>"><?php echo $url; ?></a></p>
<p>This is an automated email. Please don't reply!</p>
