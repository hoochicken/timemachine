<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Workingtime */
/* @var $form ActiveForm */
?>
<div class="workingtime-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'cid') ?>
        <?= $form->field($model, 'minutes') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'invoice_number') ?>
    <?php /*
    <?= $form->field($model, 'status')->textInput() ?>
    Html::activeDropDownList(
    $searchModel,
    'status', ['all' => 'alle', Customer::STATE_DELETED => 'gelöscht', Customer::STATE_ACTIVE => 'aktiv',],
    ['class'=>'form-control', 'prompt' => '']
    */ ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- workingtime-form -->
