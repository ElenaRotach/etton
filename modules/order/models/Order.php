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
            [['id_user', 'status', 'created_at', 'update_at', 'confirmation_at'], 'integer'],
            [['paragraph'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'id_user' => 'Пользователь',
            'paragraph' => 'Пункты',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'update_at' => 'Дата обновления',
            'confirmation_at' => 'Дата подтверждения'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderParagraphs()
    {
        return $this->hasMany(Paragraph::className(), ['id_order' => 'id']);
    }

    public function getCountParagraph(){
        return \app\modules\paragraph\models\Paragraph::find()->select(['count(id) as count'])->where(['id_order' => $this->id])->groupBy(['id_order'])->asArray()->all()[0]['count'];
    }
}
