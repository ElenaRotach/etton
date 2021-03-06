<?php

namespace app\modules\category\models;

use Yii;
use app\modules\product\Product;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $id_parent
 * @property string $name
 * @property string $description
 *
 * @property Category $idParent
 * @property Category[] $categories
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent'], 'integer'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['name', 'img'], 'string', 'max' => 255],
            [['id_parent'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_parent' => 'id']],
           // [['img'], 'image',  'mimeTypes' => 'png,jpg', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'идентификатор',
            'id_parent' => 'родительская категория',
            'name' => 'наименование',
            'description' => 'описание',
            'img' => 'Изображение'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id_parent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id_category' => 'id']);
    }
}
