<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\data\Sort;

/**
 * This is the model class for table "workingtime".
 *
 * @property int $id
 * @property int|null $cid
 * @property string|null $description
 * @property string|null $customer_company
 * @property int $minutes
 * @property string|null $date
 * @property int|null $status
 * @property string|null $invoice_number
 */
class Workingtime extends \yii\db\ActiveRecord
{

    public $customer_company = '';

    const STATE_OPEN = '0';
    const STATE_DONE = '10';
    const STATE_UNKNOWN = '15';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workingtime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cid', 'status'], 'integer'],
            [['description', 'minutes'], 'string'],
            [['customer_company'], 'string', 'max' => 255],
            [['date'], 'safe'],
            [['invoice_number'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'customer_company' => 'Kunde (Id)',
            'description' => 'Beschreibung',
            'minutes' => 'Minuten',
            'date' => 'Datum',
            'status' => 'Status',
            'invoice_number' => 'Rechnungsnummer',
        ];
    }

    public static function findOne($condition)
    {
        return parent::findOne($condition);
    }

    /**
     * {@inheritdoc}
     * @return WorkingtimeQuery the active query used by this AR class.
     */
    public static function find()
    {
        $sort = new Sort([
            'defaultOrder'=> 'date DESC',
            'attributes' => [
                'customer_company' => [
                    'asc' => ['workingtime.company' => SORT_ASC],
                    'desc' => ['workingtime.company' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
        ]);

        $query = new WorkingtimeQuery(get_called_class());
        $expCompanyDesc = new Expression('CONCAT(customer.company , "("  , workingtime.cid , ")")');
        $query->select(['workingtime.*', 'customer_company' => $expCompanyDesc])
            ->leftJoin('customer', '`workingtime`.`cid` = `customer`.`id`')
            ->orderBy($sort->orders);
        return $query;
    }
}
