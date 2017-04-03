<?php

namespace backend\modules\orders\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\orders\models\Logs;

/**
 * LogsSearch represents the model behind the search form about `backend\modules\orders\models\Logs`.
 */
class LogsSearch extends Logs
{
    public $updaterName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'updated_by'], 'integer'],
            [['object', 'object_name', 'field', 'old_value', 'new_value', 'updated_at'], 'safe'],
            ['updaterName', 'safe'],
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
        $query = Logs::find();

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
                'object',
                'object_name',
                'field',
                'old_value',
                'new_value',
                'updated_at',
                'updaterName' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                    'label' => $this->getAttributeLabel('userName')
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['user']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
                    'id' => $this->id,
                    'updated_by' => $this->updated_by])
              ->andFilterWhere(['like', 'DATE_FORMAT(logs.updated_at,\'%d-%m-%Y %T\')', $this->updated_at]);

        $query->andFilterWhere(['like', 'object', $this->object])
            ->andFilterWhere(['like', 'object_name', $this->object_name])
            ->andFilterWhere(['like', 'field', $this->field])
            ->andFilterWhere(['like', 'old_value', $this->old_value])
            ->andFilterWhere(['like', 'new_value', $this->new_value]);

        $query->joinWith(['updater' => function ($q) {
            $q->where('user.username LIKE "%' . $this->updaterName . '%"');
        }]);

        return $dataProvider;
    }
}
