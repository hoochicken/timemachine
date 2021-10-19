<?php

namespace app\models;

use Yii;
use yii\data\Sort;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * This is the model class for table "incoming".
 *
 * @property int $id
 * @property int|null $uid
 * @property int $paid
 * @property string $customer_desc
 * @property string|null $paid_date
 * @property int|null $cid
 * @property string|null $identifier
 * @property string|null $invoice_date
 * @property float|null $gross
 * @property int|null $tax_value
 * @property float|null $sales_tax
 * @property float|null $goods_sales
 * @property string|null $note
 * @property string|null $invoice_text
 * @property int $duid
 * @property string|null $dunning_text1
 * @property string|null $dunning_text2
 * @property string|null $dunning_text3
 * @property string|null $last_update
 * @property string|null $create_date
 */
class Incoming extends \yii\db\ActiveRecord
{
    public string $customer_desc;

    const STATE_PAID_DEFAULT = '1';
    const STATE_PAID_0 = '0';
    const STATE_PAID_1 = '1';
    const STATE_PAID_2 = '2';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incoming';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'paid', 'cid', 'tax_value', 'duid'], 'integer'],
            [['customer_desc'], 'string'],
            [['paid_date', 'invoice_date', 'last_update', 'create_date'], 'safe'],
            [['gross', 'sales_tax', 'goods_sales'], 'number'],
            [['note', 'invoice_text', 'dunning_text1', 'dunning_text2', 'dunning_text3'], 'string'],
            [['identifier'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'paid' => 'Bezahlt',
            'paid_date' => 'Paid Date',
            'cid' => 'Cid',
            'identifier' => 'Identifier',
            'invoice_date' => 'Invoice Date',
            'gross' => 'Gross',
            'tax_value' => 'Tax Value',
            'sales_tax' => 'Sales Tax',
            'goods_sales' => 'Goods Sales',
            'note' => 'Note',
            'invoice_text' => 'Invoice Text',
            'duid' => 'Duid',
            'dunning_text1' => 'Dunning Text1',
            'dunning_text2' => 'Dunning Text2',
            'dunning_text3' => 'Dunning Text3',
            'last_update' => 'Last Update',
            'create_date' => 'Create Date',
            'customer_desc' => 'Kunde (Id) X',
        ];
    }

    /**
     * {@inheritdoc}
     * @return IncomingQuery the active query used by this AR class.
     */
    public static function find()
    {
        $sort = new Sort([
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'attributes' => [
                'identifier' => [
                    'asc' => ['incoming.identifier' => SORT_ASC],
                    'desc' => ['incoming.identifier' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'cid' => [
                    'asc' => ['incoming.cid' => SORT_ASC],
                    'desc' => ['incoming.cid' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'id' => [
                    'asc' => ['incoming.id' => SORT_ASC],
                    'desc' => ['incoming.id' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'invoice_date' => [
                    'asc' => ['incoming.invoice_date' => SORT_ASC],
                    'desc' => ['incoming.invoice_date' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'status' => [
                    'asc' => ['incoming.status' => SORT_ASC],
                    'desc' => ['incoming.status' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'gross' => [
                    'asc' => ['incoming.gross' => SORT_ASC],
                    'desc' => ['incoming.gross' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'paid' => [
                    'asc' => ['incoming.paid' => SORT_ASC],
                    'desc' => ['incoming.paid' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'paid_date' => [
                    'asc' => ['incoming.paid_date' => SORT_ASC],
                    'desc' => ['incoming.paid_date' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
        ]);
        $query = new IncomingQuery(get_called_class());
        $query->select(['incoming.*'])
            ->orderBy($sort->orders)
        ;
        return $query;
    }
}
