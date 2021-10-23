<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Todo */
/* @var $form ActiveForm */
?>
<div class="todo-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'customer_id') ?>
        <?= $form->field($model, 'done') ?>
        <?= $form->field($model, 'state') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'description') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- todo-form -->
