<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property int $customer_id
 * @property string $customer_company
 * @property string $customer_surname
 * @property string $customer_name
 * @property string $customer_addendum
 * @property string $customer_street
 * @property string $customer_postcode
 * @property string $customer_city
 * @property string $customer_country
 * @property float $customer_salary
 * @property int $state
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'text', 'customer_id', 'customer_company', 'customer_surname', 'customer_name', 'customer_addendum', 'customer_street', 'customer_postcode', 'customer_city', 'customer_country', 'customer_salary', 'state'], 'required'],
            [['description'], 'string'],
            [['customer_id', 'state'], 'integer'],
            [['customer_salary'], 'number'],
            [['title', 'text', 'customer_company', 'customer_surname', 'customer_name', 'customer_addendum', 'customer_street', 'customer_city', 'customer_country'], 'string', 'max' => 255],
            [['customer_postcode'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'text' => 'Text',
            'customer_id' => 'Customer ID',
            'customer_company' => 'Customer Company',
            'customer_surname' => 'Customer Surname',
            'customer_name' => 'Customer Name',
            'customer_addendum' => 'Customer Addendum',
            'customer_street' => 'Customer Street',
            'customer_postcode' => 'Customer Postcode',
            'customer_city' => 'Customer City',
            'customer_country' => 'Customer Country',
            'customer_salary' => 'Customer Salary',
            'state' => 'State',
        ];
    }

    /**
     * {@inheritdoc}
     * @return InvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InvoiceQuery(get_called_class());
    }
}
