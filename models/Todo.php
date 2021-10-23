<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int $customer_id
 * @property int $done
 * @property int $state
 */
class Todo extends \yii\db\ActiveRecord
{
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
            [['customer_id'], 'required'],
            [['customer_id', 'done', 'state'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 700],
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
            'customer_id' => 'Customer ID',
            'done' => 'Done',
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