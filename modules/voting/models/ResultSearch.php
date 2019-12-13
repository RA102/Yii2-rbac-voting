<?php

namespace app\modules\voting\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\voting\models\Result;

/**
 * ResultSearch represents the model behind the search form of `app\modules\voting\models\Result`.
 */
class ResultSearch extends Result
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'member_id', 'result_id', 'type_id', 'status_student_id', 'active'], 'integer'],
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
        if (empty($params)) {
            $obj = Member::getMemberIdByActive();
            $params = [
                'ResultSearch' => [
                    'member_id' => $obj->id,
                    'type_id' => '',
                ],
            ];
        }
        $query = Result::find();

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
            'user_id' => $this->user_id,
            'member_id' => $this->member_id,
            'result_id' => $this->result_id,
            'type_id' => $this->type_id,
            'status_student_id' => $this->status_student_id,
            'active' => $this->active,
        ]);

        return $dataProvider;
    }
}
