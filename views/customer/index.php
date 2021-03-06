<?php

use app\models\Customer;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $items app\models\Customer[] */
/* @var $pages \yii\data\Pagination */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= LinkPager::widget([ 'pagination' => $pages,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'company',
            'surname',
            'name',
            'status' =>
                [
                    'label' => 'Status',
                    'attribute' => 'status',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status', ['all' => 'alle', Customer::STATE_DELETED => 'gelöscht', Customer::STATE_ACTIVE => 'aktiv',],
                        ['class'=>'form-control', 'prompt' => '']
                    ),
                ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
