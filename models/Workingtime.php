<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workingtime".
 *
 * @property int $woid
 * @property int|null $cid
 * @property string|null $description
 * @property int $minutes
 * @property string|null $date
 * @property int|null $status
 * @property string|null $invoice_number
 */
class Workingtime extends \yii\db\ActiveRecord
{
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
            'cid' => 'Cid',
            'description' => 'Description',
            'minutes' => 'Minutes',
            'date' => 'Date',
            'status' => 'Status',
            'invoice_number' => 'Invoice Number',
        ];
    }

    /**
     * {@inheritdoc}
     * @return WorkingtimeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkingtimeQuery(get_called_class());
    }
}
