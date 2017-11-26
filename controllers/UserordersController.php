<?php

namespace app\controllers;

use app\modules\order\models\Order;
use app\modules\order\models\OrderSearch;
use app\modules\paragraph\models\Paragraph;
use app\modules\paragraph\models\ParagraphSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\data\ActiveDataProvider;

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
        $order = Order::find()->where(['id_user'=>Yii::$app->user->getId()])->andWhere(['status'=>1])->one();
        if(isset($order)){
            $query = $this->dataProvider($order->id);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        }else{
            $dataProvider = null;
        }

        $ordersSearch = new OrderSearch();
        $ordersProvider = $ordersSearch->search(Yii::$app->request->queryParams, Yii::$app->user->getId());
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'ordersSearch' => $ordersSearch,
            'ordersProvider' => $ordersProvider
        ]);
    }

    public function actionAddproduct($id)
    {

        if(Yii::$app->request->isPost){

            $request =Yii::$app->request->post();

            $idActiveOrder = Order::find()->where(['id_user'=>Yii::$app->user->getId()])->andWhere(['status'=>1])->one();
            //r_dump($idActiveOrder);exit();

            if(is_null($idActiveOrder)){

                $order = new Order();
                $order->id_user = Yii::$app->user->getId();
                $order->status = 1;
                $order->created_at = time();
                $order->save();
                $idActiveOrder = $order->id;
            }else{
                $order = Order::findOne($idActiveOrder);
                $order->update_at = time();
                $order->save();
                $idActiveOrder = $order->id;
            }
            //var_dump($idActiveOrder);exit();

            $paragraph = new Paragraph();
            $paragraph->count = 1;
            $paragraph->id_product = $id;
            $paragraph->id_order = $idActiveOrder;

            $ordersSearch = new OrderSearch();
            $ordersProvider = $ordersSearch->search(Yii::$app->request->queryParams, Yii::$app->user->getId());

            $query = $this->dataProvider(Order::find()->where(['id_user'=>Yii::$app->user->getId()])->andWhere(['status'=>1])->one()->id);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if($paragraph->save()){
                return $this->render('index',[
                    'dataProvider' => $dataProvider,
                    'ordersSearch' => $ordersSearch,
                    'ordersProvider' => $ordersProvider
                ]);
            }else{
                //var_dump($paragraph->errors);exit();
                throw new \Exception('Упс');
                //return $this->render('/catalog/product/index?id=' . $id);
            }
        }
    }

    private function dataProvider($idOrder){

        $query = Paragraph::find()
            ->where(['id_order'=>$idOrder]);

        return $query;
    }

    public function actionDelete($id){

        $paragraph = Paragraph::findOne($id);
        $paragraph->delete();

        $query = $this->dataProvider(Order::find()->where(['id_user'=>Yii::$app->user->getId()])->andWhere(['status'=>1])->one()->id);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $ordersSearch = new OrderSearch();
        $ordersProvider = $ordersSearch->search(Yii::$app->request->queryParams, Yii::$app->user->getId());
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'ordersSearch' => $ordersSearch,
            'ordersProvider' => $ordersProvider
        ]);
    }
}