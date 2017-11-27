<?php

namespace app\controllers;

use app\modules\order\models\Order;
use app\modules\order\models\OrderSearch;
use app\modules\paragraph\models\Paragraph;
use app\modules\paragraph\models\ParagraphSearch;
use app\modules\product\models\Product;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

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
        $data = $this->dataProvider();

        return $this->render('index',[
            'dataProvider' => $data[0],
            'ordersSearch' => $data[1],
            'ordersProvider' => $data[2]
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

            //$data = $this->dataProvider();



            if($paragraph->save()){
              /*  return $this->render('index',[
                    'dataProvider' => $data[0],
                    'ordersSearch' => $data[1],
                    'ordersProvider' => $data[2]
                ]);*/
                Yii::$app->response->redirect(Url::to('\userorders\index'));
            }else{
                //var_dump($paragraph->errors);exit();
                throw new \Exception('Упс');
                //return $this->render('/catalog/product/index?id=' . $id);
            }
        }
    }

    private function dataProvider(){

        $order = Order::find()->where(['id_user'=>Yii::$app->user->getId()])->andWhere(['status'=>1])->one();
        if(isset($order)){
            //$query = $this->dataProvider($order->id);
            $query = Paragraph::find()
                ->where(['id_order'=>$order->id]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }else{
            $dataProvider = null;
        }

        $ordersSearch = new OrderSearch();
        $ordersProvider = $ordersSearch->search(Yii::$app->request->queryParams, Yii::$app->user->getId());

        $data = [$dataProvider, $ordersSearch, $ordersProvider];

        return $data;
    }

    public function actionDelete($id){

        $paragraph = Paragraph::findOne($id);
        $paragraph->delete();

        /*$data = $this->dataProvider();

        return $this->render('index',[
            'dataProvider' => $data[0],
            'ordersSearch' => $data[1],
            'ordersProvider' => $data[2]
        ]);*/
    }

    public function actionGetcount(){
        if(Yii::$app->request->isGet){
            $request = Yii::$app->request->get();
            $paragraph = Paragraph::findOne($request['id']);
                $paragraph->count += $request['sign'];
                $product = Product::findOne($paragraph->id_product);
                $product->count -= $request['sign'];
                $product->update();

            if($paragraph->update()){

                $query = Paragraph::find()
                    ->select(['p.count', '(p.count * prod.price) as sum', 'prod.count as rez'])
                    ->alias('p')
                    ->leftJoin(Product::tableName() . ' prod', 'p.id_product=prod.id')
                    ->where(['p.id'=>$paragraph->id])
                    ->asArray()
                    ->all();
                $query = Json::encode($query);
                return $query;
            }
        }else{
            return false;
        }
    }

    public function actionConfirmation(){

        //throw new \Exception();
        $order = Order::find()->where(['id_user'=>Yii::$app->user->getId()])->andWhere(['status'=>1])->one();
        //var_dump($order->status);exit();
        $order->status = 2;
        $order->confirmation_at = time();
        $order->update();

        /*$data = $this->dataProvider();

        return $this->render('index',[
            'dataProvider' => $data[0],
            'ordersSearch' => $data[1],
            'ordersProvider' => $data[2]
        ]);*/
        Yii::$app->response->redirect(Url::to('\userorders\index'));
    }
}