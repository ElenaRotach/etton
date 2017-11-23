<?php

namespace app\modules\product\models;

use Yii;
use app\modules\category\models\Category;
use app\modules\paragraph\models\Paragraph;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $id_category
 * @property string $name
 * @property string $description
 * @property integer $count
 * @property string $price
 *
 * @property OrderParagraph[] $orderParagraphs
 * @property Category $idCategory
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'count'], 'integer'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name', 'img'], 'string', 'max' => 255],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'id_category' => 'Категория',
            'name' => 'Наименование',
            'description' => 'Описание',
            'count' => 'Количество',
            'price' => 'Цена',
            'img' => 'Изображение'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderParagraphs()
    {
        return $this->hasMany(Paragraph::className(), ['id_product' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }
}
