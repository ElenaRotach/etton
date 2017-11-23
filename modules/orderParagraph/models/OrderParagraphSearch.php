<?php

namespace app\modules\orderParagraph\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\orderParagraph\models\OrderParagraph;

/**
 * OrderParagraphSearch represents the model behind the search form about `app\modules\orderParagraph\models\OrderParagraph`.
 */
class OrderParagraphSearch extends OrderParagraph
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
        $query = OrderParagraph::find();

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
