<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customer;
use yii\db\Expression;

/**
 * CustomerSearch represents the model behind the search form of `app\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['company', 'companysalary', 'surname', 'name', 'addendum', 'street', 'postcode', 'city', 'country', 'description'], 'safe'],
            [['salary'], 'number'],
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
        $query = Customer::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, isset($params['CustomerOptions']) ? 'CustomerOptions' : null);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $expr = new Expression('IF (`company` != "", CONCAT(`company` , " (" , `id` , ")"), CONCAT(`surname` , ", " , `name` , " (" , `id` , ")"))');
        $expr2 = new Expression('IF (`company` != "", CONCAT(`company` , " (" , `id`, ") " , `salary` , " EUR/h"), CONCAT(`surname` , ", " , `name` , " (" , `id`, ") " , `salary` , " EUR/h"))');
        $query->select(['customer.*', 'company' => $expr, 'companysalary' => $expr2]);

        // grid filtering conditions
        if ('' === $this->status) $this->status = self::STATE_DEFAULT;
        $status = 'all' === $this->status ? null : $this->status;

        // $stateValid = self::STATE_DELETED === $this->status || self::STATE_ACTIVE === $this->status;
        $query->andFilterWhere([
            'id' => $this->id,
            'salary' => $this->salary,
            // 'status' => $stateValid ? $this->status : self::STATE_ACTIVE,
            'status' => $status ?? self::STATE_DEFAULT,
        ]);

        $query->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'addendum', $this->addendum])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
