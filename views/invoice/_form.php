<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'customer_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_addendum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_salary')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
