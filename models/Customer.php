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
 * @property int $id
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
 * @property string|null $companysalary
 */
class Customer extends \yii\db\ActiveRecord
{
    const STATE_DEFAULT = '1';
    const STATE_ACTIVE = '1';
    const STATE_DELETED = '0';

    public $companysalary;

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
            [['companysalary'], 'string'],
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
                ],
                'id' => [
                    'asc' => ['customer.id' => SORT_ASC],
                    'desc' => ['customer.id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'status' => [
                    'asc' => ['customer.status' => SORT_ASC],
                    'desc' => ['customer.status' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'surname' => [
                    'asc' => ['customer.surname' => SORT_ASC],
                    'desc' => ['customer.surname' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'name' => [
                    'asc' => ['customer.name' => SORT_ASC],
                    'desc' => ['customer.name' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
        ]);

        $query = new CustomerQuery(get_called_class());
        // $expr = new Expression('IF (`company` != "", `company`, CONCAT(`surname` , ", " , `name`))');
        $expr = new Expression('IF (`company` != "", CONCAT(`company` , " (" , `id` , ")"), CONCAT(`surname` , ", " , `name` , " (" , `id` , ")"))');
        $expr2 = new Expression('IF (`company` != "", CONCAT(`company` , " (" , `id` , ") ", `salary` , "EUR/h"), CONCAT(`surname` , ", " , `name` , " (" , `id` , ") ", `salary` , "EUR/h"))');
        $query->select(['customer.*', 'company' => $expr, 'companysalary' => $expr2])
            ->orderBy($sort->orders)
        ;
        return $query;
    }
}
