<?php

namespace app\models;

use Yii;
use yii\data\Sort;

/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $url
 * @property string|null $customer_desc
 * @property int|null $customer_id
 * @property int $done
 * @property string $date
 * @property int $state
 */
class Todo extends \yii\db\ActiveRecord
{
    public $customer_desc = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['customer_id', 'done', 'state'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 700],
            [['date'], 'string', 'max' => 20],
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
            'url' => 'Url',
            'customer_id' => 'Customer ID',
            'done' => 'Done',
            'date' => 'Datum',
            'state' => 'State',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TodoQuery the active query used by this AR class.
     */
    public static function find()
    {
        $sort = new Sort([
            'defaultOrder' => [
                'date' => SORT_DESC
            ],
            'attributes' => [
                'id' => [
                    'asc' => ['todo.id' => SORT_ASC],
                    'desc' => ['todo.id' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'date' => [
                    'asc' => ['todo.date' => SORT_ASC],
                    'desc' => ['todo.date' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'description' => [
                    'asc' => ['todo.description' => SORT_ASC],
                    'desc' => ['todo.description' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
        ]);

        $query = new TodoQuery(get_called_class());
        $query->select(['todo.*'])
            ->orderBy($sort->orders);
        return $query;

        // return new TodoQuery(get_called_class());
    }
}
