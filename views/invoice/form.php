<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form ActiveForm */
?>
<div class="invoice-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'text') ?>
        <?= $form->field($model, 'customer_id') ?>
        <?= $form->field($model, 'customer_company') ?>
        <?= $form->field($model, 'customer_surname') ?>
        <?= $form->field($model, 'customer_name') ?>
        <?= $form->field($model, 'customer_addendum') ?>
        <?= $form->field($model, 'customer_street') ?>
        <?= $form->field($model, 'customer_postcode') ?>
        <?= $form->field($model, 'customer_city') ?>
        <?= $form->field($model, 'customer_country') ?>
        <?= $form->field($model, 'customer_salary') ?>
        <?= $form->field($model, 'state') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- invoice-form -->
