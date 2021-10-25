<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Todo;
use yii\db\Expression;

/**
 * TodoSearch represents the model behind the search form of `app\models\Todo`.
 */
class TodoSearch extends Todo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'done', 'state'], 'integer'],
            [['title', 'customer_id', 'description'], 'safe'],
            [['date'], 'safe'],
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
        $query = Todo::find();

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

        $expCompanyDesc = new Expression('IF (`customer`.`company` != "", CONCAT(`customer`.`company` , " (" , `customer`.`id` , ")"), CONCAT(`customer`.`surname` , ", " , `customer`.`name` , " (" , `customer`.`id` , ")"))');
        $query->select(['todo.*', 'customer_desc' => $expCompanyDesc])
            ->leftJoin('customer', '`todo`.`customer_id` = `customer`.`id`');

        // grid filtering conditions
        $query->andFilterWhere([
            'todo.id' => $this->id,
            'todo.customer_id' => $this->customer_id,
            'todo.done' => $this->done,
            'todo.state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'todo.title', $this->title])
            ->andFilterWhere(['like', 'todo.description', $this->description]);

        return $dataProvider;
    }
}
