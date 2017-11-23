<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_paragraph`.
 */
class m171123_081514_create_order_paragraph_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('order_paragraph', [
            'id' => $this->primaryKey(),
            'id_order' => $this->integer()->comment('Идентификатор заказа'),
            'id_product' => $this->integer()->comment("Идентификатор продукта"),
            'count' => $this->integer()->comment('Количество')
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('order_paragraph');
    }
}
