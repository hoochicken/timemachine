<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'customer_company') ?>

    <?php // echo $form->field($model, 'customer_surname') ?>

    <?php // echo $form->field($model, 'customer_name') ?>

    <?php // echo $form->field($model, 'customer_addendum') ?>

    <?php // echo $form->field($model, 'customer_street') ?>

    <?php // echo $form->field($model, 'customer_postcode') ?>

    <?php // echo $form->field($model, 'customer_city') ?>

    <?php // echo $form->field($model, 'customer_country') ?>

    <?php // echo $form->field($model, 'customer_salary') ?>

    <?php // echo $form->field($model, 'state') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
