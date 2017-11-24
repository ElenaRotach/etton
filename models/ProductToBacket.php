<?php

namespace app\models;

use yii\base\Model;

class ProductToBacket extends Model
{
    public $user;
    public $product;

    public function rules()
    {
        return [

            [['user', 'product'], 'required'],
            [['user', 'product'], 'integer'],
        ];
    }

}