<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $form ActiveForm */
?>
<div class="incoming-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'uid') ?>
        <?= $form->field($model, 'paid') ?>
        <?= $form->field($model, 'cid') ?>
        <?= $form->field($model, 'tax_value') ?>
        <?= $form->field($model, 'duid') ?>
        <?= $form->field($model, 'paid_date') ?>
        <?= $form->field($model, 'invoice_date') ?>
        <?= $form->field($model, 'last_update') ?>
        <?= $form->field($model, 'create_date') ?>
        <?= $form->field($model, 'gross') ?>
        <?= $form->field($model, 'sales_tax') ?>
        <?= $form->field($model, 'goods_sales') ?>
        <?= $form->field($model, 'note') ?>
        <?= $form->field($model, 'invoice_text') ?>
        <?= $form->field($model, 'dunning_text1') ?>
        <?= $form->field($model, 'dunning_text2') ?>
        <?= $form->field($model, 'dunning_text3') ?>
        <?= $form->field($model, 'identifier') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- incoming-form -->
