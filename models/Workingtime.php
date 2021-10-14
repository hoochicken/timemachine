<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\data\Sort;

/**
 * This is the model class for table "workingtime".
 *
 * @property int $woid
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

    public $customer_company;
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
            [['cid', 'minutes', 'status'], 'integer'],
            [['description'], 'string'],
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
            'attributes' => [
                'date' => [
                    'asc' => ['workingtime.date' => SORT_ASC],
                    'desc' => ['workingtime.date' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Date',
                ],
                'id' => [
                    'asc' => ['workingtime.id' => SORT_ASC],
                    'desc' => ['workingtime.id' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Date',
                ],
                'customer_company' => [
                    'asc' => ['workingtime.company' => SORT_ASC],
                    'desc' => ['workingtime.company' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'CompanyCompany',
                ],
                'description' => [
                    'asc' => ['workingtime.description' => SORT_ASC],
                    'desc' => ['workingtime.description' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Description',
                ],
                'minutes' => [
                    'asc' => ['workingtime.minutes' => SORT_ASC],
                    'desc' => ['workingtime.minutes' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Description',
                ],
                'status' => [
                    'asc' => ['workingtime.status' => SORT_ASC],
                    'desc' => ['workingtime.status' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Status',
                ],
                'invoice_number' => [
                    'asc' => ['workingtime.invoice_number' => SORT_ASC],
                    'desc' => ['workingtime.invoice_number' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Rechnungsnummer',
                ],
            ],
        ]);

        $query = new WorkingtimeQuery(get_called_class());
        $expCompanyDesc = new Expression('CONCAT(customer.company , "("  , workingtime.cid , ")")');
        $query->select(['workingtime.*', 'customer_company' => $expCompanyDesc])
            ->leftJoin('customer', '`workingtime`.`cid` = `customer`.`id`')
            ->orderBy($sort->orders);
        ;
        return $query;
    }
}
