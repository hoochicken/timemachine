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
/* @var $workingtimeProvider \yii\data\ActiveDataProvider */
/* @var $update bool */
$disabled = !$update;
$users = $userProvider->getModels();
$customers = $customerProvider->getModels();

$workingtimesText = ArrayHelper::map($workingtimeProvider->getModels(), 'id', 'description');
array_walk($workingtimesText, function (&$item) { $item = '* ' . $item; });
echo Html::script('
    const introtext = "This is a dummie text";
    const anotherText = "This is a another dummie text";

    function insertIntrotext() {
        insertAtCursor($("#incoming-invoice_text"), introtext); 
    }
    function insertAnotherText() {
        insertAtCursor($("#incoming-invoice_text"), anotherText);
    }
    function insertAtCursor(textareaElement, insertString) { 
            var $t = textareaElement[0];
            if (document.selection) { 
                this.focus(); 
                var sel = document.selection.createRange(); 
                sel.text = insertString; 
                this.focus(); 
                return;
            }
            if ($t.selectionStart || $t.selectionStart == "0") { 
                var startPos = $t.selectionStart; 
                var endPos = $t.selectionEnd; 
                var scrollTop = $t.scrollTop; 
                $t.value = $t.value.substring(0, startPos) + insertString + $t.value.substring(endPos, $t.value.length); 
                this.focus(); 
                $t.selectionStart = startPos + insertString.length; 
                $t.selectionEnd = startPos + insertString.length; 
                $t.scrollTop = scrollTop; 
                return;
            }  
            this.value += insertString; 
            this.focus(); 
        }  
', ['type' => 'text/javascript']);
$invoice_text_default = implode("\n", $workingtimesText);
?>
<?php if ($update) : ?>
<div>
    <?= Html::button('Introtext', ['onclick' => 'insertIntrotext()', 'class' => 'btn btn-info']); ?>
    <?= Html::button('Another Text', ['onclick' => 'insertAnotherText()', 'class' => 'btn btn-info']); ?>
</div>
<?php endif; ?>
<div class="incoming-form">

    <?= $form->field($model, 'cid')->dropDownList(ArrayHelper::map($customers, 'id', 'companysalary'),  ['class'=>'form-control', 'disabled' => $disabled,]) ?>

    <?= $form->field($model, 'gross')->textInput(['maxlength' => true, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'tax_value')->dropDownList(['0' => '0 %', '19' => '19 %', '16' => '16 %',], ['class' => 'form-control', 'onchange' => 'calculateTaxes()', 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'sales_tax')->textInput(['maxlength' => true, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'goods_sales')->textInput(['maxlength' => true, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'invoice_text')->textarea(['rows' => 6, 'disabled' => $disabled, 'value' => !empty($model->invoice_text) ? $model->invoice_text : $invoice_text_default]) ?>

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
