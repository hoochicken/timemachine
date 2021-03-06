<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Workingtime */
/* @var $customerProvider \yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */

$customers = $customerProvider->getModels();
?>

<div class="workingtime-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cid')->dropDownList(ArrayHelper::map($customers, 'id', 'company'),
        ['class'=>'form-control',]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'minutes')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'invoice_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
