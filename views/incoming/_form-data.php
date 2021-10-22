<?php

use app\models\Incoming;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $form yii\widgets\ActiveForm */
/* @var $userProvider \yii\data\ActiveDataProvider */
$users = $userProvider->getModels();
?>
<div class="incoming-form">
    <?= Html::beginTag('div', ['class' => 'd-flex flex-row']) ?>
    <?= Html::beginTag('div', ['class' => 'flex-fill col-md-6']) ?>
    <?= $form->field($model, 'identifier')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'invoice_date')->textInput() ?>
    <?= $form->field($model, 'uid')->dropDownList(ArrayHelper::map($users, 'id', 'surname'),  ['class'=>'form-control',]) ?>
    <?= Html::endTag('div'); ?>
    <?= Html::beginTag('div', ['class' => 'flex-fill col-md-6']) ?>
    <?= $form->field($model, 'paid')->dropDownList([Incoming::STATE_PAID_1 => '1', Incoming::STATE_PAID_2 => '2', Incoming::STATE_PAID_0 => '0'],  ['class'=>'form-control',]) ?>
    <?= $form->field($model, 'paid_date')->textInput() ?>
    <?= Html::endTag('div'); ?>
    <?= Html::endTag('div'); ?>
</div>
