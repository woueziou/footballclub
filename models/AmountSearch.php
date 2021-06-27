<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Amount;

/**
 * AmountSearch represents the model behind the search form of `app\models\Amount`.
 */
class AmountSearch extends Amount
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'PAYMENT'], 'integer'],
            [['value', 'tax'], 'number'],
            [['create_at', 'update_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Amount::find();

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
            'value' => $this->value,
            'tax' => $this->tax,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'PAYMENT' => $this->PAYMENT,
        ]);

        return $dataProvider;
    }
}
