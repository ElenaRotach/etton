<?php

use yii\db\Migration;

/**
 * Class m171123_184856_add_img_from_product
 */
class m171123_184856_add_img_from_product extends Migration
{
    public function safeUp()
    {
        $this->addColumn('product', 'img', $this->string()->comment('Изображение'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'img');
    }
}
