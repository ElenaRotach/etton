<?php

namespace app\modules\order\models;

use app\modules\paragraph\models\Paragraph;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\order\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\modules\order\models\Order`.
 */
class OrderSearch extends Order
{
    public $countParagraph;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'status', 'created_at', 'update_at', 'confirmation_at', 'countParagraph'], 'integer'],
            [['paragraph'], 'safe'],
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
    public function search($params, $id)
    {

        $query = Order::find();

        if($id != null){
            $query->where(['id_user'=>$id]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
/*        $dataProvider->setSort([
            'attributes' => [
                'countParagraph' => [
                    'asc' => [
                        $query->select(['o.id', 'o.id_user', 'o.status', 'o.created_at', 'o.update_at', 'o.confirmation_at', 'count(p.id) as countParagraph'])
                                ->alias('o')
                                ->leftJoin(Paragraph::tableName() . ' p', 'p.id_order=o.id')->groupBy(['o.id'])
                        'countParagraph' => SORT_ASC],
                    'desc' => ['countParagraph' => SORT_DESC],
                    'label' => 'Количество товаров в заказе',
                    'default' => SORT_ASC
                ],
                'country_id'
            ]
        ]);*/
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_user' => $this->id_user,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'confirmation_at' => $this->confirmation_at,
            //'countParagraph' => $this->countParagraph
        ]);
        if(isset($this->countParagraph) && $this->countParagraph!=""){
            $query->select(['o.id', 'o.id_user', 'o.status', 'o.created_at', 'o.update_at', 'o.confirmation_at', 'count(p.id) as countParagraph']);
            $query->alias('o');
            //SELECT `o`.`id`, `o`.`id_user`, `o`.`status`, `o`.`created_at`, `o`.`update_at`, `o`.`confirmation_at`, count(p.id) as countParagraph FROM `order` `o` LEFT JOIN `order_paragraph` `p` ON p.id_order=o.id GROUP BY o.id HAVING countParagraph = 6
            $query->leftJoin(Paragraph::tableName() . ' p', 'p.id_order=o.id')->groupBy(['o.id'])->having(['countParagraph'=> $this->countParagraph]);
        }
        $query->andFilterWhere(['like', 'paragraph', $this->paragraph]);

        return $dataProvider;
    }
}
