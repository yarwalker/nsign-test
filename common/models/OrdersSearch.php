<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `common\models\Orders`.
 */
class OrdersSearch extends Orders
{
    public $goodName;
    public $goodPrice;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'good_id' ], 'integer'],
            [['name', 'customer_fio', 'customer_phone', 'comments', 'status'], 'safe'],
            [['goodName', 'created_at'], 'safe'],
            ['price', 'double'],
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
        $query = Orders::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $this::find()->count(),
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'name',
                'customer_fio',
                'customer_phone',
                'goodName' => [
                    'asc' => ['goods.name' => SORT_ASC],
                    'desc' => ['goods.name' => SORT_DESC],
                    'label' => $this->getAttributeLabel('goodName')
                ],
                'status',
                'created_at',
                'comments',
                'price',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['goods']);
            return $dataProvider;
        }

        //$this->addCondition($query, 'good_id');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'good_id' => $this->good_id,
            'orders.price' => $this->price,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
            //'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'customer_fio', $this->customer_fio])
            ->andFilterWhere(['like', 'customer_phone', $this->customer_phone])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'DATE_FORMAT(orders.created_at,\'%d-%m-%Y %T\')', $this->created_at]);

        $query->joinWith(['good' => function ($q) {
            $q->where('goods.name LIKE "%' . $this->goodName . '%"');
        }]);

        //die($query->createCommand()->rawSql);

        return $dataProvider;
    }


}
