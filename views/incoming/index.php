<?php

use app\models\Incoming;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncomingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $customerProvider yii\data\ActiveDataProvider */

$customers = $customerProvider->getModels();

$this->title = 'Incomings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoming-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Incoming', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'identifier',
            // 'cid',
            'customer_desc' =>
                [
                    'label' => 'Kunde (Id)',
                    'format' => 'ntext',
                    'attribute' =>'customer_desc',
                    'value' => function($model) {
                        return $model->customer_desc;
                    },
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'customer_desc',
                        ArrayHelper::map($customers, 'id', 'company'),
                        ['class'=>'form-control', 'prompt' => '']
                    )
                ],
            // 'invoice_text:ntext',
            'invoice_date',
            'paid' =>
                [
                    'label' => 'Bezahlt',
                    'attribute' => 'paid',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'paid', ['all' => 'alle', Incoming::STATE_PAID_1 => '1', Incoming::STATE_PAID_2 => '2', Incoming::STATE_PAID_0 => '0',],
                        ['class'=>'form-control', 'prompt' => '']
                    ),
                ],
            'paid_date',
            // 'uid',
            //'gross',
            //'tax_value',
            //'sales_tax',
            //'goods_sales',
            //'note:ntext',
            //'duid',
            //'dunning_text1:ntext',
            //'dunning_text2:ntext',
            //'dunning_text3:ntext',
            //'last_update',
            //'create_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
