<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_status`.
 */
class m171123_081537_create_order_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_status', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Наименование')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_status');
    }
}
