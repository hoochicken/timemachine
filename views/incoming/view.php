<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incomings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="incoming-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uid',
            'paid',
            'paid_date',
            'cid',
            'identifier',
            'invoice_date',
            'gross',
            'tax_value',
            'sales_tax',
            'goods_sales',
            'note:ntext',
            'invoice_text:ntext',
            'duid',
            'dunning_text1:ntext',
            'dunning_text2:ntext',
            'dunning_text3:ntext',
            'last_update',
            'create_date',
        ],
    ]) ?>

</div>
