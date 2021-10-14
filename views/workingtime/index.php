<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkingtimeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $customerProvider yii\data\ActiveDataProvider */

$customers = $customerProvider->getModels();

$this->title = 'Workingtimes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workingtime-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Workingtime', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            // 'cid',
            'customer_company' =>
                [
                    'label' => 'Kunde (Id)',
                    'format' => 'ntext',
                    'attribute'=>'customer_company',
                    'value' => function($model) {
                        return $model->customer_company;
                    },
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'customer_company',
                        ArrayHelper::map($customers, 'id', 'company'),
                            ['class'=>'form-control', 'prompt' => '']
                    )
                ],
            'description:ntext',
            'minutes',
            'date',
            'status' =>
                [
                    'label' => 'Status',
                    'attribute'=>'status',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status', [0 => 'open', 10 => 'abgerechnet', 15 => 'unbekannte 15'],
                        ['class'=>'form-control', 'prompt' => '']
                    )
                ],
            'invoice_number',
            'checker' => [
                'class' => 'yii\grid\CheckboxColumn',
                // you may configure additional properties here
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
