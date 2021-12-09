<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $workingtimeProvider \yii\data\ActiveDataProvider */
/* @var $customerProvider \yii\data\ActiveDataProvider */
/* @var $userProvider \yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */
/* @var $update boolean */

$users = $userProvider->getModels();
$customers = $customerProvider->getModels();
$this->title = 'Incoming > Create';
$this->params['breadcrumbs'][] = ['label' => 'Incomings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin(['id' => 'invoiceData']);
?>
<script type="text/javascript">
    let salaryByCustomerId = [];
    <?php foreach ($customers as $customer) echo sprintf('salaryByCustomerId[%s] = %s', $customer->id, $customer->salary) . ';' . "\n"; ?>
    function calculateTaxes() {
        // get numbers for calculation
        let customerId = $('#incoming-cid').val();
        let stundensatz = salaryByCustomerId[customerId];
        let arbeitszeit = $('#time-sum').val() / 60;
        let steuersatz = $('#incoming-tax_value').val() / 100;

        // pre-calculations
        let netto = arbeitszeit * stundensatz;
        let steuer = netto * steuersatz;
        let brutto = netto + steuer;

        // pin to form
        $('#incoming-goods_sales').val(netto);
        $('#incoming-sales_tax').val(steuer);
        $('#incoming-gross').val(brutto);
    }
</script>
<script>
    function submitForm() {
        let raw = document.getElementById("invoiceData");
        let form = raw.cloneNode(true);
        form.setAttribute('target', '_blank');
        form.setAttribute('method', 'post');
        form.setAttribute('action', '/index.php?r=incoming%2Fprintbypost');
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }
</script>
<div class="incoming-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">Basis</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="dunning-tab" data-toggle="tab" href="#dunning" role="tab" aria-controls="dunning" aria-selected="false">Mahnung</a>
        </li>
        <li class="nav-item ml-auto p-2" role="presentation">
            <?php if ($update) : ?>
                <div class="form-group">
                    <?= Html::button('Print', ['class' => 'btn btn-success', 'onclick' => 'submitForm();return false;']) ?>
                </div>
            <?php else : ?>
                <?= Html::a('Print', ['printbyid', 'id' => $model->id], ['class' => 'btn btn-primary', 'target' => '_blank',]) ?>
            <?php endif; ?>
        </li>
        <li class="nav-item ml-auto p-2" role="presentation">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
            <?= Html::beginTag('div', ['class' => 'd-flex flex-row']) ?>
            <?= Html::beginTag('div', ['class' => 'flex-fill col-md-6']) ?>
            <?= $this->render('_form-basic', [
                'model' => $model,
                'userProvider' => $userProvider,
                'workingtimeProvider' => $workingtimeProvider,
                'customerProvider' => $customerProvider,
                'form' => $form,
                'update' => $update,
            ]) ?>
            <?= Html::endTag('div') ?>
            <?= Html::beginTag('div', ['class' => 'flex-fill col-md-6']) ?>
            <?= $this->render('_form-data', [
                'model' => $model,
                'userProvider' => $userProvider,
                'form' => $form,
                'update' => $update,
            ]) ?>
            <?= $this->render('_workingtime', [
                'model' => $model,
                'workingtimeProvider' => $workingtimeProvider,
                'customerProvider' => $customerProvider,
                'form' => $form,
                'update' => $update,
            ]) ?>
            <?= Html::endTag('div') ?>
            <?= Html::endTag('div') ?>
        </div>
        <div class="tab-pane fade" id="dunning" role="tabpanel" aria-labelledby="dunning-tab">
            <?= $this->render('_form-dunning', [
                'model' => $model,
                'userProvider' => $userProvider,
                'form' => $form,
                'update' => $update,
            ]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
