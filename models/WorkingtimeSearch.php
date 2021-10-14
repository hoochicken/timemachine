<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * WorkingtimeSearch represents the model behind the search form of `app\models\Workingtime`.
 */
class WorkingtimeSearch extends Workingtime
{
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
        $query = Workingtime::find();

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

        $expCompanyDesc = new Expression('CONCAT(customer.company , " ("  , workingtime.cid , ")")');
        $query->select(['workingtime.*', 'customer_company' => $expCompanyDesc]);

        // grid filtering conditions
        $status = 'all' === $this->status ? null : $this->status;
        if (is_null($this->status)) $this->status = self::STATE_OPEN;
                
        // grid filtering conditions
        $query->andFilterWhere([
                'workingtime.id' => $this->id,
                'workingtime.cid' => $this->cid,
                'workingtime.date' => $this->date,
                'workingtime.status' => $status ?? self::STATE_OPEN,
            ])
            ->andFilterWhere(['like', 'workingtime.description', $this->description])
            ->andFilterWhere(['like', 'workingtime.invoice_number', $this->invoice_number])
            ->andFilterWhere(['like', 'customer.id', $this->customer_company])
        ;

        if (is_integer($this->minutes)) $query->andFilterWhere(['workingtime.minutes' => $this->minutes]);
        elseif (str_starts_with($this->minutes,'>=') || str_starts_with($this->minutes,'<=')) {
            $value = substr($this->minutes,2);
            $query->andFilterWhere([substr($this->minutes,0, 2), 'workingtime.minutes', $value]);
        } elseif (str_starts_with($this->minutes,'>') || str_starts_with($this->minutes,'<')) {
            $value = substr($this->minutes,1);
            $query->andFilterWhere([substr($this->minutes,0, 1), 'workingtime.minutes', $value]);
        }

        return $dataProvider;
    }
}
