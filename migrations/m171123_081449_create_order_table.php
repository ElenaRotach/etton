<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m171123_081449_create_order_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->comment("Идентификатор пользователя"),
            'paragraph' => $this->text()->comment('Идентификаторы пунктов'),
            'status' => $this->integer()->defaultValue(0)->comment('Статус заказа')
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('order');
    }
}
