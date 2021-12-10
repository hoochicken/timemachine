<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

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
        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            // return $dataProvider;
        }

        $selectedIds = $params['WorkingtimeIds'] ?? null;

        $expCompanyDesc = new Expression('IF (`customer`.`company` != "", CONCAT(`customer`.`company` , " (" , `customer`.`id` , ")"), CONCAT(`customer`.`surname` , ", " , `customer`.`name` , " (" , `customer`.`id` , ")"))');
        $query->select(['workingtime.*', 'customer_company' => $expCompanyDesc]);

        // grid filtering conditions
        if ('all' === $this->status) $status = null;
        elseif (is_null($this->status)) $status = self::STATE_OPEN;
        else $status = $this->status;

        // grid filtering conditions
        $query->andFilterWhere([
                'workingtime.id' => $this->id,
                'workingtime.cid' => $this->cid,
                'workingtime.date' => $this->date,
                'workingtime.status' => $status,
            ])
            ->andFilterWhere(['like', 'workingtime.description', $this->description])
            ->andFilterWhere(['like', 'customer.id', $this->customer_company])
            ->andFilterWhere(['in', 'workingtime.id',  $selectedIds])
        ;

        if (is_numeric($this->minutes)) $query->andFilterWhere(['workingtime.minutes' => $this->minutes]);
        elseif (str_starts_with($this->minutes,'>=') || str_starts_with($this->minutes,'<=')) {
            $value = substr($this->minutes,2);
            $query->andFilterWhere([substr($this->minutes,0, 2), 'workingtime.minutes', $value]);
        } elseif (str_starts_with($this->minutes,'>') || str_starts_with($this->minutes,'<')) {
            $value = substr($this->minutes,1);
            $query->andFilterWhere([substr($this->minutes,0, 1), 'workingtime.minutes', $value]);
        }

        if (is_numeric($this->invoice_number) && ('0' === $this->invoice_number || 0 === $this->invoice_number || is_null($this->invoice_number))) {
            $query->andWhere(['or', ['workingtime.invoice_number' => null], ['workingtime.invoice_number' => 0]]);
        } elseif (is_numeric($this->invoice_number)) {
            $query->andWhere(['workingtime.invoice_number' => $this->invoice_number]);
        } elseif (str_starts_with($this->invoice_number,'>=') || str_starts_with($this->invoice_number,'<=')) {
            $value = substr($this->invoice_number,2);
            $query->andFilterWhere([substr($this->invoice_number,0, 2), 'workingtime.invoice_number', $value]);
        } elseif (str_starts_with($this->invoice_number,'>') || str_starts_with($this->invoice_number,'<')) {
            $value = substr($this->invoice_number,1);
            $query->andFilterWhere([substr($this->invoice_number,0, 1), 'workingtime.invoice_number', $value]);
        }

        return $dataProvider;
    }

    function sumUpMinutes($params): float|int
    {
        $dataProvider = $this->search($params);
        $dataProvider->getPagination()->setPageSize(0);
        $models = $dataProvider->getModels();
        $minutes = ArrayHelper::map($models, 'id', 'minutes');
        return array_sum($minutes);
    }
}
