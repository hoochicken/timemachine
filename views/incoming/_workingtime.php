<?php

use app\models\Workingtime;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $workingtimeProvider yii\data\ActiveDataProvider */
/* @var $customerProvider yii\data\ActiveDataProvider */

$minutes = array_sum(array_map(function($item) { return $item->minutes; }, $workingtimeProvider->getModels()));
$hours = round($minutes / 60, 2);

?>
<div class="incoming-workingtime-form">

    <?= GridView::widget([
        'dataProvider' => $workingtimeProvider,
        'filterModel' => $workingtimeProvider,
        'showFooter' => true,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'customer_company' => [
                'attribute' => 'customer_company',
                'label' => 'asda',
                'header' => 'asda',
            ],
            // 'cid',
            'description' => [
                'attribute' => 'description',
                'value' => function($model) {
                    return StringHelper::truncateWords($model->description, 5, '...', true);
                }
            ],
            'minutes' => [
                'attribute' =>'minutes',
                'footer' => $minutes . ' min (' . $hours . ' h)'
            ],
            'date',
            // 'status',
            // 'invoice_number',
            'checker' => [ 'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => ['checked' => '1']]
        ]
    ]); ?>

</div>
