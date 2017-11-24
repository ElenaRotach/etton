<?php

namespace app\controllers;

use app\modules\order\models\Order;
use app\modules\paragraph\models\Paragraph;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
class UserordersController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionAddproduct($id)
    {

        if(Yii::$app->request->isPost){

            $request =Yii::$app->request->post();

            $idActiveOrder = Order::find()->where(['id_user'=>Yii::$app->user->getId()])->andWhere(['status'=>1])->one()->id;
            //r_dump($idActiveOrder);exit();

            if(is_null($idActiveOrder)){

                $order = new Order();
                $order->id_user = Yii::$app->user->getId();
                $order->status = 1;
                $order->save();
                $idActiveOrder = $order->id;
            }
            //var_dump($idActiveOrder);exit();

            $paragraph = new Paragraph();
            $paragraph->count = 0;
            $paragraph->id_product = $id;
            $paragraph->id_order = $idActiveOrder;
            if($paragraph->save()){
                return $this->render('index');
            }else{
                var_dump($paragraph->errors);exit();
                throw new \Exception('Упс');
                //return $this->render('/catalog/product/index?id=' . $id);
            }
        }
    }
}