<?php

namespace app\widgets\randomProduct;

use app\modules\order\models\Order;
use app\modules\paragraph\models\Paragraph;
use app\modules\product\models\Product;
use yii\base\Widget;
use Yii;

class RandomProductWidget extends Widget
{

    public function run()
    {
        parent::run();

        $data = $this->dataProvider();
        return $this->render('index', [
            'dataProvider' => $this->dataProvider()
        ]);
    }

    private function dataProvider(){

        $max = Product::find()
            ->select(['max(id) as id'])
            ->all();

        $rnd_id = [];
        $data = [];

        while (count($rnd_id)<6){

            $rnd = random_int(0, $max[0]->id);
            $prod = Product::findOne($rnd);

            if(isset($prod)){
                //var_dump(in_array($prod->id, $rnd_id));exit();
                if(!in_array($prod->id, $rnd_id)) {

                    array_push($data, $prod);
                    array_push($rnd_id, $prod->id);
                }
            }

        }
        return $data;
    }
}