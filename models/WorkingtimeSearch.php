<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Workingtime;
use yii\db\Expression;

/**
 * WorkingtimeSearch represents the model behind the search form of `app\models\Workingtime`.
 *
 * @property int $woid
 * @property int|null $cid
 * @property string|null $description
 * @property string|null $company_company
 * @property int $minutes
 * @property string|null $date
 * @property int|null $status
 * @property string|null $invoice_number
 */
class WorkingtimeSearch extends Workingtime
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'minutes', 'status'], 'integer'],
            [['company_company'], 'string', 'max' => 255],
            [['description', 'date', 'invoice_number'], 'safe'],
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
        $query->select(['workingtime.*', 'company_company' => $expCompanyDesc]);

        // grid filtering conditions
        $query->andFilterWhere([
            'workingtime.id' => $this->id,
            'workingtime.cid' => $this->cid,
            // 'workingtime.description' => $this->description,
            // 'customer.company_company' => $this->cid,
            'workingtime.minutes' => $this->minutes,
            'workingtime.date' => $this->date,
            'workingtime.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'workingtime.description', $this->description])
            ->andFilterWhere(['like', 'workingtime.invoice_number', $this->invoice_number])
            ->andFilterWhere(['like', 'customer.company', $this->company_company]);

        return $dataProvider;
    }
}
