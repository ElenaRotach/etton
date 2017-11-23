<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m171123_081415_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'id_category' => $this->integer()->comment("Идентификатор категории"),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'description' => $this->text()->comment('Описание'),
            'count' => $this->integer()->defaultValue(0)->comment('Количество в наличии'),
            'price' => $this->decimal()->defaultValue(0)->comment('Цена')
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('product');
    }
}
