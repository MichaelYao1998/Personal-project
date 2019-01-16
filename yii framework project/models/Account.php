<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "account".
 *
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $password_check
 */
//https://blog.csdn.net/a403852386/article/details/79429255: email related
class Account extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $id;
    public $auth_key;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'password_check'], 'required', 'on' => ['signUp', 'create', 'update']],
            [['username', 'password', 'password_check'], 'required', 'on' => ['change']],
            [['username', 'email', 'password', 'password_check'], 'string', 'max' => 100],
            [['username'], 'unique', 'on' => ['signUp']],
            ['password', 'passwordCheck', 'on' => ['signUp', 'change']],
            ['username', 'usernameCheck', 'on' => ['change']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'password_check' => 'Password Check',
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $model = new Account();
        $model->username = $this->username;
        $model->email = $this->email;
        $model->password = $this->password;
        $model->password_check = $this->password_check;
        if ($this->password == $this->password_check) {
//            $model->setPassword($model->password);
            $model->password = md5($model->password);
            $model->password_check = md5($model->password_check);
        }
        //generate remember me auth key
        $model->generateAuthKey();
        return $model->save(false);
    }

    public function setPassword($password)
    {
        try {
            $this->password = Yii::$app->security->generatePasswordHash($password);
        } catch (Exception $e) {
            $this->addError($e, 'Something goes wrong');
        }
    }

    public function generateAuthKey()
    {
        try {
            $this->auth_key = Yii::$app->security->generateRandomString();
            $this->save();
        } catch (Exception $e) {
            $this->addError($e, 'Something goes wrong');
        }
    }

    /*
     * Check whether password matches password check
     */
    public function passwordCheck($attribute)
    {
        if ($this->password != $this->password_check) {
            $this->addError($attribute, "Password does not match");
        }
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }


    public function validatePassword($password)
    {
        return md5($password) == $this->password;
//        return $this->setPassword($password)== $this->password;
    }

    /*
     * check username whether in the database
     */
    public function usernameCheck($attribute)
    {
//        $name = Yii::$app->request->get('username');
        $user = Account::findOne(['username' => $this->username]);
        if (!$user) {
            $this->addError($attribute, 'username does not exist');
        }
    }

    /*
     * perform update password function
     */
    public function updatePassword()
    {
        if (!$this->validate()) {
            return null;
        } else {
            $model = new Account();
            $model->password = $this->password;
            $model->password_check = $this->password_check;
            if ($this->password == $this->password_check) {
                $model->password = md5($model->password);
                $model->password_check = md5($model->password_check);
				//update password = $model->password where username = $this->username
                $model::updateAll(['password' => $model->password], ['username' => $this->username]);
                $model::updateAll(['password' => $model->password_check], ['username' => $this->username]);
            }
        }
    }

    /*
     * Perform send email function
     */
    public function seekPass($data)
    {
        if ($this->load($data) && $this->validate()) {
            $time = time();
            //Yii::$app->mailer->compose(): create email message
            $mailer = Yii::$app->mailer->compose('seekpass');
            $mailer->setFrom("y.aoyu.chen@163.com");//发件人
            $mailer->setTo($data['Account']['email']);//收件人
            $mailer->setSubject("Find back password");
            if ($mailer->send()) {
                return true;
            }
        }
        return false;
    }

    //signature
    public function createToken($administrator, $time)
    {
        return md5(md5($administrator) . base64_encode(Yii::$app->request->userIP) . md5($time));
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        return $this->auth_key === $authKey;
    }

}
