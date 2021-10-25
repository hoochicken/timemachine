<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Todo */
/* @var $form yii\widgets\ActiveForm */
/* @var $customerProvider \yii\data\ActiveDataProvider */
?>
<div class="todo-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group d-flex">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success ml-auto mr-2 p-2']) ?>
        <?= Html::submitButton('Save & New', ['class' => 'btn btn-success p-2', 'onclick' => '$("#saveAndNew").val(1);submit();']) ?>
        <?= Html::hiddenInput('saveAndNew', 0, ['id' => 'saveAndNew']) ?>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map($customerProvider->getModels(), 'id', 'company'),  ['class'=>'form-control',]) ?>

    <?= $form->field($model, 'done')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <div class="form-group d-flex">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success ml-auto mr-2 p-2']) ?>
        <?= Html::submitButton('Save & New', ['class' => 'btn btn-success p-2', 'onclick' => '$("#saveAndNew").val(1);submit();']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
