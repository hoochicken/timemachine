<?php

use app\models\Workingtime;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $workingtimeProvider yii\data\ActiveDataProvider */
/* @var $customerProvider yii\data\ActiveDataProvider */
?>
<div class="incoming-workingtime-form">

    <?= GridView::widget([
        'dataProvider' => $workingtimeProvider,
        'filterModel' => $workingtimeProvider,
        'showFooter' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'customer_company',
            'description:ntext',
            'minutes' => [
                'attribute' =>'minutes',
                'footer' => round(array_sum(array_map(function($item) {
                            return $item->minutes;
                        }, $workingtimeProvider->getModels())) / 60, 2) . ' h'
            ],
            'date',
            'status',
            'invoice_number',
            'checker' => [
                'class' => 'yii\grid\CheckboxColumn',
                // you may configure additional properties here
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
