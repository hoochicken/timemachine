<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $customerProvider yii\data\ActiveDataProvider */
$customers = $customerProvider->getModels();

$this->title = 'Todos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Todo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'url' => [
                'attribute' => 'url',
                'label' => 'Info',
                'value' => function ($model) { return Html::a(substr($model->url, 0, 100), $model->url, ['target' => '_blank']) . '<br />' . substr($model->description, 0, 100);},
                'format' => 'raw',
            ],
            'customer_id' =>
                [
                    'label' => 'Kunde (Id)',
                    'format' => 'ntext',
                    'attribute' =>'customer_id',
                    'value' => function($model) {
                        return $model->customer_desc ?? '';
                    },
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'customer_id',
                        ArrayHelper::map($customers, 'id', 'company'),
                        ['class'=>'form-control', 'prompt' => '']
                    )
                ],
            'date' => [
                'attribute' => 'date',
                'label' => 'Datum',
                'value' => function ($model) { return substr($model->date, 0, 10); }],
            'done' => [
                'attribute' => 'done',
                'label' => 'Done',
                'value' => function ($model) { return 1 === (int) $model->done ? Html::tag('span', $model->done, []) : Html::a('done', '/index.php?r=todo/done&id=' . $model->id, ['class' => 'btn btn-info']); },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'done',
                    [0 => 'Todo', 1 => 'Erledigt'],
                    ['class'=>'form-control', 'prompt' => '']
                ),
                'format' => 'raw',
            ],
            //'state',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
