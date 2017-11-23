<?php

namespace app\modules\order\models;

use Yii;
use app\modules\paragraph\Paragraph;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $paragraph
 * @property integer $status
 *
 * @property OrderParagraph[] $orderParagraphs
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'status'], 'integer'],
            [['paragraph'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'paragraph' => 'Paragraph',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderParagraphs()
    {
        return $this->hasMany(Paragraph::className(), ['id_order' => 'id']);
    }
}
