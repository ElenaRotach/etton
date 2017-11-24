<?php

namespace app\controllers;

use app\modules\category\models\Category;
use app\modules\product\models\Product;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CatalogController extends Controller
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

    public function actionIndex($id)
    {
        $id_cat = ($id=="")? null: $id;

        return $this->render('index',[
            'data' => $this->initCatalog($id_cat)
        ]);
    }

    private function initCatalog($id=null)
    {
        $dataCat = Category::find()->where(['id_parent' => $id])->asArray()->all();
        $dataProd = Product::find()->where(['id_category' => $id])->asArray()->all();
        $data = [$dataCat, $dataProd];
        return  $data;
    }

    public function actionProduct($id)
    {
        if($id != ""){
            $product = Product::findOne($id);
        }else{
            throw new \Exception("Ошибка получения данных");
        }
        return $this->render('product',[
            'data' => $product
        ]);
    }
}