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
echo Html::script('
    const introtext = "This is a dummie text";
    const anotherText = "This is a another dummie text";
    function insertIntrotext() {
        let text = $("#incoming-invoice_text").val();
        $("#incoming-invoice_text").val(text + "\n" + introtext);
    }
    function insertAnotherText() {
        let text = $("#incoming-invoice_text").val();
        $("#incoming-invoice_text").val(text + "\n" + anotherText);
    }
', ['type' => 'text/javascript'])
?>
<div>
    <?= Html::button('Introtext', ['onclick' => 'insertIntrotext()', 'class' => 'btn btn-info']); ?>
    <?= Html::button('Another Text', ['onclick' => 'insertAnotherText()', 'class' => 'btn btn-info']); ?>
</div>
<div class="incoming-form">

    <?= $form->field($model, 'cid')->dropDownList(ArrayHelper::map($customers, 'id', 'company'),  ['class'=>'form-control',]) ?>

    <?= $form->field($model, 'gross')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tax_value')->dropDownList(['0' => '0 %', '19' => '19 %', '16' => '16 %',], ['class' => 'form-control', 'onchange' => 'calculateTaxes()']) ?>

    <?= $form->field($model, 'sales_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goods_sales')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last_update')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'create_date')->textInput(['disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
