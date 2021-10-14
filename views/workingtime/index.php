<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkingtimeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
            'customer_company',
            'description:ntext',
            'minutes',
            'date',
            'status',
            'invoice_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
