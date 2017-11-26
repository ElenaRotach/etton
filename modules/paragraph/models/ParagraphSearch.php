<?php

namespace app\modules\paragraph\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\modules\paragraph\models\Paragraph;

/**
 * ParagraphSearch represents the model behind the search form about `app\modules\paragraph\models\OrderParagraph`.
 */
class ParagraphSearch extends Paragraph
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_order', 'id_product', 'count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Paragraph::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_order' => $this->id_order,
            'id_product' => $this->id_product,
            'count' => $this->count,
        ]);

        return $dataProvider;
    }


}
