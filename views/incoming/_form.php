<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incoming-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    <?= $form->field($model, 'paid_date')->textInput() ?>

    <?= $form->field($model, 'cid')->textInput() ?>

    <?= $form->field($model, 'identifier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_date')->textInput() ?>

    <?= $form->field($model, 'gross')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tax_value')->textInput() ?>

    <?= $form->field($model, 'sales_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goods_sales')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'invoice_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'duid')->textInput() ?>

    <?= $form->field($model, 'dunning_text1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dunning_text2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dunning_text3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
