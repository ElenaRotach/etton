<?php

namespace app\widgets\basketHeader;

use app\modules\order\models\Order;
use app\modules\paragraph\models\Paragraph;
use app\modules\product\models\Product;
use yii\base\Widget;
use Yii;

class BasketHeaderWidget extends Widget
{

    public function run()
    {
        parent::run();

        $data = $this->dataProvider();
        return $this->render('index', [
            'sum' => $data['sum'],
            'count' => $data['count']
        ]);
    }

    private function dataProvider(){

        $orders = Order::find()
            ->where(['id_user' => Yii::$app->user->getId()])
            ->asArray()
            ->all();

        $sum = 0;

        foreach ($orders as $o){

            $paragraph = Paragraph::find()
                ->select(['sum(count) as count', 'id_product'])
                ->where(['id_order' => $o['id']])
                ->groupBy(['id_product'])
                ->asArray()
                ->all();

            foreach ($paragraph as $p){

                $sum += ($p['count'] * Product::findOne($p['id_product'])->price);
            }

            /*if(isset($paragraph[0]['sum'])){

                $sum += $paragraph[0]['sum'];
            }*/
        }
        $data = ['sum'=>$sum, 'count'=>count($orders)];
        return $data;
    }
}