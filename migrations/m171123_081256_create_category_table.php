<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171123_081256_create_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'id_parent' => $this->integer()->comment("Идентификатор родительской категории"),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'description' => $this->text()->comment('Описание')
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('category');
    }
}
