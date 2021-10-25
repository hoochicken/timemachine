<?php

namespace app\models;

use Yii;

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
        return new TodoQuery(get_called_class());
    }
}
