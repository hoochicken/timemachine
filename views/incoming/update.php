<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $workingtimeProvider \yii\data\ActiveDataProvider */
/* @var $customerProvider \yii\data\ActiveDataProvider */
/* @var $userProvider \yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */

$users = $userProvider->getModels();
$this->title = 'Incoming > Update: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incomings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$form = ActiveForm::begin();
?>
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
                'customerProvider' => $customerProvider,
                'form' => $form,
            ]) ?>
            <?= Html::endTag('div') ?>
            <?= Html::beginTag('div', ['class' => 'flex-fill col-md-6']) ?>
            <?= $this->render('_form-data', [
                'model' => $model,
                'userProvider' => $userProvider,
                'form' => $form,
            ]) ?>
            <?= $this->render('_workingtime', [
                'model' => $model,
                'workingtimeProvider' => $workingtimeProvider,
                'customerProvider' => $customerProvider,
                'form' => $form,
            ]) ?>
            <?= Html::endTag('div') ?>
            <?= Html::endTag('div') ?>
        </div>
        <div class="tab-pane fade" id="dunning" role="tabpanel" aria-labelledby="dunning-tab">
            <?= $this->render('_form-dunning', [
                'model' => $model,
                'userProvider' => $userProvider,
                'form' => $form,
            ]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
