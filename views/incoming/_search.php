<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IncomingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incoming-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'paid') ?>

    <?= $form->field($model, 'paid_date') ?>

    <?= $form->field($model, 'cid') ?>

    <?php // echo $form->field($model, 'identifier') ?>

    <?php // echo $form->field($model, 'invoice_date') ?>

    <?php // echo $form->field($model, 'gross') ?>

    <?php // echo $form->field($model, 'tax_value') ?>

    <?php // echo $form->field($model, 'sales_tax') ?>

    <?php // echo $form->field($model, 'goods_sales') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'invoice_text') ?>

    <?php // echo $form->field($model, 'duid') ?>

    <?php // echo $form->field($model, 'dunning_text1') ?>

    <?php // echo $form->field($model, 'dunning_text2') ?>

    <?php // echo $form->field($model, 'dunning_text3') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
