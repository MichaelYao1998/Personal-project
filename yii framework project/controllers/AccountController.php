<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use app\models\Account;
use app\models\AccountSearch;
use yii\base\ExitException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Account::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $query->count(),
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'username' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Account model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Account();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->username]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->username]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRegister()
    {
        $model = new Account();
        $model->scenario = 'signUp';//rules scenario
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['welcome']);
        } else {
            return $this->render('register', ['model' => $model]);
        }
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['welcome']);
        } else {
            return $this->render('login', ['model' => $model]);
        }
    }


    public function actionWelcome()
    {
        $model = new LoginForm();
        return $this->render('welcome', ['model' => $model]);

    }

    /*
     * Pagination method
     */
    public function actionShow()
    {
        /*
         * offset: 从哪开始
         * limit:　检索的行数
         * e.g. LIMIT 4 OFFSET 3: 返回从第3行起的4行数据
         */
        $query = Account::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $account = $query->orderBy('username')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('show', [
            'account' => $account,
            'pagination' => $pagination,
        ]);
    }

    /*
     *  Perform download as csv function
     *  Reference link: https://blog.csdn.net/qq_35296546/article/details/70226678
     */
    public function actionDownload()
    {
        $name = Yii::$app->request->get('username');
        $arrName = empty($name) ? [] : explode(',', $name);
        $title = 'username,email,password,password check' . "\n";
        $fileName = 'Account' . date('Ymd') . '.csv';
        $dataArr = Account::find()->andFilterWhere(['in', 'username', $arrName])->asArray()->all();
        $formValue = "";
        if (!empty($dataArr)) {
            foreach ($dataArr as $key => $value) {
                $formValue .= $value['username'] . "," . $value['email'] . "," . $value['password'] . "," . $value['password_check'];
                $formValue .= "\n";
            }
        }
        $this->CsvExport($fileName, $title, $formValue);
    }

    public function CsvExport($file = '', $title = '', $data)
    {
        //disposition/encoding on response body
        header('Content-Disposition:attachment;filename =' . $file);
        header('Content-Transfer-Encoding: binary');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Cache-control: must-revalidate');
        header('Pragma: public');
        //form title
        $formValue = $title;
        //content
        $formValue .= $data;
        /*
         * ignore means ignore error during the conversion
         * iconv:  Convert string to requested character encoding
         * string iconv ( string $in_charset , string $out_charset , string $str )
         * Performs a character set conversion on the string str from in_charset to out_charset
         * charset: 字符集
         */
        $formValue = iconv("utf-8", "GBK//ignore", $formValue);
        echo $formValue;
    }

    /*
     * Perform download as pdf file function
     */
    public function actionDownloadPdf()
    {

    }

    public function actionSeekpass()
    {
        $model = new Account();
        if (Yii::$app->request->isPost) {
            //接收post数据
            $post = Yii::$app->request->post();

            //调用model
            if ($model->seekPass($post)) {
                Yii::$app->session->setFlash('info', 'Email sent successully, please check.');
                Yii::$app->session->setFlash('info', "If don;t find the email, please check spam.");
            }
        }
        return $this->render('seekPass', ['model' => $model]);
    }

    public function actionChangepass()
    {
        $model = new Account();
        //接收时间戳
        /* $time = Yii::$app->request->get("timestamp");
         //接收用户名
         $adminuser = Yii::$app->request->get("username");
         //接收token
         $token = Yii::$app->request->get("token");

         $myToken = $model->createToken($adminuser, $time);
         //验证token
         if ($token != $myToken) {
 //            $this->redirect(['login']);
             try {
                 Yii::$app->end();
             } catch (ExitException $e) {
             }
         }
         //计算是否超时
         if (time() - $time > 3000) {
             //overtime amd direct to login page
             $this->redirect(['login']);
             try {
                 Yii::$app->end();
             } catch (ExitException $e) {
             }
         }
         if (Yii::$app->request->isPost) {
             $post = Yii::$app->request->post();
             if ($model->changePass($post)) {
                 Yii::$app->session->setFlash("info", "change password successfully");
             }
         }
         $model->username = $adminuser;
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             return $this->redirect(['welcome']);
         } else {*/
        $model = new Account();
        if ($model->load(Yii::$app->request->post()) && $model->updatePassword()) {
            return $this->render("welcome", ['model' => $model]);
        }else{
            return $this->render("changePass", ['model' => $model]);
        }
    }
}

