<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "workingtime".
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
class Workingtime extends \yii\db\ActiveRecord
{

    public $company_company;
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
            [['company_company'], 'string', 'max' => 255],
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
            'woid' => 'Woid',
            'cid' => 'Company',
            'company_company' => 'CompanyDesc',
            'description' => 'Description',
            'minutes' => 'Minutes',
            'date' => 'Date',
            'status' => 'Status',
            'invoice_number' => 'Invoice Number',
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
        $query = new WorkingtimeQuery(get_called_class());
        $expCompanyDesc = new Expression('CONCAT(customer.company , "("  , workingtime.cid , ")")');
        $query->select(['workingtime.*', 'company_company' => $expCompanyDesc]);
        $query->leftJoin('customer', '`workingtime`.`cid` = `customer`.`id`');
        return $query;
    }
}
