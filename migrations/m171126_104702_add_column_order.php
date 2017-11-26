<?php

use yii\db\Migration;

/**
 * Class m171126_104702_add_column_order
 */
class m171126_104702_add_column_order extends Migration
{
    public function safeUp()
    {
        $this->addColumn('order', 'created_at', $this->integer()->notNull()->comment('Дата создания'));
        $this->addColumn('order', 'update_at', $this->integer()->comment('Дата обновления'));
        $this->addColumn('order', 'confirmation_at', $this->integer()->comment('Дата подтверждения'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('order', 'created_at');
        $this->dropColumn('order', 'update_at');
        $this->dropColumn('order', 'confirmation_at');
    }
}
