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
/* @var $update bool */
$disabled = !$update;
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
<?php if ($update) : ?>
<div>
    <?= Html::button('Introtext', ['onclick' => 'insertIntrotext()', 'class' => 'btn btn-info']); ?>
    <?= Html::button('Another Text', ['onclick' => 'insertAnotherText()', 'class' => 'btn btn-info']); ?>
</div>
<?php endif; ?>
<div class="incoming-form">

    <?= $form->field($model, 'cid')->dropDownList(ArrayHelper::map($customers, 'id', 'company'),  ['class'=>'form-control', 'disabled' => $disabled,]) ?>

    <?= $form->field($model, 'gross')->textInput(['maxlength' => true, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'tax_value')->dropDownList(['0' => '0 %', '19' => '19 %', '16' => '16 %',], ['class' => 'form-control', 'onchange' => 'calculateTaxes()', 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'sales_tax')->textInput(['maxlength' => true, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'goods_sales')->textInput(['maxlength' => true, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'invoice_text')->textarea(['rows' => 6, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'last_update')->textInput(['disabled' => $disabled]) ?>

    <?= $form->field($model, 'create_date')->textInput(['disabled' => $disabled]) ?>

    <?php if ($update) : ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php else : ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?php endif; ?>
</div>
