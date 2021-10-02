<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form ActiveForm */
?>
<div class="Customer-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'salary') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'company') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'addendum') ?>
        <?= $form->field($model, 'street') ?>
        <?= $form->field($model, 'postcode') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'country') ?>
        <?= $form->field($model, 'surname') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- Customer-form -->
