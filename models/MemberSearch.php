<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Member;

/**
 * MemberSearch represents the model behind the search form of `app\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'status_student_id'], 'integer'],
            [['name', 'faculty', 'department', 'specialty', 'theme', 'data'], 'safe'],
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
        if (\Yii::$app->user->identity)
//        $params['MemberSearch']['data'] = \Yii::$app->formatter->asDate($params['MemberSearch']['data'], 'php: Y-m-d');

        /*
         * echo "<pre>";
        print_r($params);die;
        */

        $query = Member::find();

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
            'active' => $this->active,
            'status_student_id' => $this->status_student_id,
            'data' => $this->data,  //\Yii::$app->formatter->asDate($this->data, 'php: j.n.Y'),
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'faculty', $this->faculty])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'specialty', $this->specialty])
            ->andFilterWhere(['like', 'theme', $this->theme]);

        return $dataProvider;
    }
}
