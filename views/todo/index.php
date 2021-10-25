<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $customerProvider yii\data\ActiveDataProvider */

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
            'customer_id' => [
                'attribute' => 'customer_id',
                'label' => 'Kunde (Id)',
            ],
            'done' => [
                'attribute' => 'done',
                'label' => 'done',
                'value' => function ($model) { return 1 === (int) $model->done ? Html::tag('span', $model->done, []) : Html::a('done', '/index.php?r=todo/done&id=' . $model->id, ['class' => 'btn btn-info']); },
                'format' => 'raw',
            ],
            //'state',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
