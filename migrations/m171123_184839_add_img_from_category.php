<?php

use yii\db\Migration;

/**
 * Class m171123_184839_add_img_from_category
 */
class m171123_184839_add_img_from_category extends Migration
{
    public function safeUp()
    {
        $this->addColumn('category', 'img', $this->string()->comment('Изображение'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('category', 'img');
    }
}
