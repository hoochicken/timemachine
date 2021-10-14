<?php

namespace app\models;

use Yii;
use yii\base\BaseObject;
use yii\data\Sort;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * This is the model class for table "customer".
 *
 * @property int $cid
 * @property string|null $company
 * @property string|null $surname
 * @property string|null $name
 * @property string|null $addendum
 * @property string|null $street
 * @property string|null $postcode
 * @property string|null $city
 * @property string|null $country
 * @property string|null $description
 * @property float|null $salary
 * @property int|null $status
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['salary'], 'number'],
            [['status'], 'integer'],
            [['company', 'name', 'addendum', 'street', 'postcode', 'city', 'country'], 'string', 'max' => 255],
            [['surname'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'Cid',
            'company' => 'Company',
            'surname' => 'Surname',
            'name' => 'Name',
            'addendum' => 'Addendum',
            'street' => 'Street',
            'postcode' => 'Postcode',
            'city' => 'City',
            'country' => 'Country',
            'description' => 'Description',
            'salary' => 'Salary',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {

        $sort = new Sort([
            'defaultOrder' => [
                'company' => SORT_ASC
            ],
            'attributes' => [
                'company' => [
                    'asc' => ['customer.company' => SORT_ASC],
                    'desc' => ['customer.company' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Date',
                ],
            ],
        ]);

        $query = new WorkingtimeQuery(get_called_class());
        $query->select(['customer.*'])
            ->orderBy($sort->orders);
        ;
        return $query;
        // return new CustomerQuery(get_called_class());
    }
}
