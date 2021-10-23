<?php

use app\models\Incoming;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $form yii\widgets\ActiveForm */
/* @var $userProvider \yii\data\ActiveDataProvider */
/* @var $customerProvider \yii\data\ActiveDataProvider */
$users = $userProvider->getModels();
$customers = $customerProvider->getModels();
?>
<div class="incoming-form">

    <?= $form->field($model, 'cid')->dropDownList(ArrayHelper::map($customers, 'id', 'company'),  ['class'=>'form-control',]) ?>

    <?= $form->field($model, 'gross')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tax_value')->textInput() ?>

    <?= $form->field($model, 'sales_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goods_sales')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'invoice_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
