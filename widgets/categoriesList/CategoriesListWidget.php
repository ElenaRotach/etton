<?php

namespace app\widgets\categoriesList;

//use app\modules\category\Category;
use app\modules\category\models\Category;
use yii\base\Widget;

class CategoriesListWidget extends Widget

{
    public function run()
    {
        parent::run();

        return $this->render('index', [
            'dataProvider' => $this->dataProvider()
        ]);
    }

    private function dataProvider(){

        $query = Category::find()
            ->where(['id_parent' => null]);

        return $query;
    }
}