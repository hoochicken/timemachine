<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Incoming;
use yii\db\Expression;

/**
 * IncomingSearch represents the model behind the search form of `app\models\Incoming`.
 */
class IncomingSearch extends Incoming
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'paid', 'cid', 'tax_value', 'duid'], 'integer'],
            [['customer_desc', 'paid_date', 'identifier', 'invoice_date', 'note', 'invoice_text', 'dunning_text1', 'dunning_text2', 'dunning_text3', 'last_update', 'create_date'], 'safe'],
            [['gross', 'sales_tax', 'goods_sales'], 'number'],
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
        $query = Incoming::find();

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

        $this->load($params, isset($params['IncomingSearch']) ? 'IncomingSearch' : null);

        $expr = new Expression('IF (`company` != "", CONCAT(`company` , " (" , customer.`id` , ")"), CONCAT(customer.`surname` , ", " , customer.`name` , " (" , customer.`id` , ")"))');
        $query
            ->select(['incoming.*', 'customer_desc' => $expr])
            ->leftJoin('customer', '`incoming`.`cid` = `customer`.`id`');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'uid' => $this->uid,
            'paid' => $this->paid,
            'paid_date' => $this->paid_date,
            'cid' => $this->customer_desc,
            'invoice_date' => $this->invoice_date,
            'gross' => $this->gross,
            'tax_value' => $this->tax_value,
            'sales_tax' => $this->sales_tax,
            'goods_sales' => $this->goods_sales,
            'duid' => $this->duid,
            'last_update' => $this->last_update,
            'create_date' => $this->create_date,
            // 'customer_desc' => $this->customer_desc,
        ]);

        $query->andFilterWhere(['like', 'identifier', $this->identifier])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'invoice_text', $this->invoice_text])
            ->andFilterWhere(['like', 'dunning_text1', $this->dunning_text1])
            ->andFilterWhere(['like', 'dunning_text2', $this->dunning_text2])
            ->andFilterWhere(['like', 'dunning_text3', $this->dunning_text3])
        ;

        return $dataProvider;
    }
}
