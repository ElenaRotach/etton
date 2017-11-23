<?php

use yii\db\Migration;

/**
 * Class m171123_082545_add_foreign_keys
 */
class m171123_082545_add_foreign_keys extends Migration
{
    public function up()
    {

        $this->createIndex(
            'idx-category-id_parent',
            'category',
            'id_parent'
        );

        $this->addForeignKey(
            'fk-category-id_parent',
            'category',
            'id_parent',
            'category',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product-category',
            'product',
            'id_category'
        );

        $this->addForeignKey(
            'fk-product-id_category',
            'product',
            'id_category',
            'category',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-paragraph-order',
            'paragraph',
            'id_order'
        );

        $this->addForeignKey(
            'fk-paragraph-id_order',
            'paragraph',
            'id_order',
            'order',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-paragraph-product',
            'paragraph',
            'id_product'
        );

        $this->addForeignKey(
            'fk-paragraph-id_product',
            'paragraph',
            'id_product',
            'product',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropIndex(
            'idx-category-id_parent',
            'category'
        );

        $this->dropForeignKey(
            'fk-category-id_parent',
            'category'
        );

        $this->dropIndex(
            'idx-product-category',
            'product'
        );
        $this->dropForeignKey(
            'fk-product-id_category',
            'product'
        );
        $this->dropIndex(
            'idx-order_product-order',
            'order_product'
        );
        $this->dropForeignKey(
            'fk-order_product-id_order',
            'order_product'
        );
        $this->dropIndex(
            'idx-order_product-product',
            'order_product'
        );
        $this->dropForeignKey(
            'fk-order_product-id_product',
            'order_product'
        );
    }
}
