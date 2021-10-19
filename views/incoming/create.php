<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $workingtimeProvider \yii\data\ActiveDataProvider */
/* @var $customerProvider \yii\data\ActiveDataProvider */
/* @var $userProvider \yii\data\ActiveDataProvider */

$this->title = 'Create Incoming';
$this->params['breadcrumbs'][] = ['label' => 'Incomings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoming-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex flex-row">
        <div class="flex-fill col-md-6">
            <?= $this->render('_form', [
                'model' => $model,
                'userProvider' => $userProvider,
            ]) ?>
        </div>
        <div class="flex-fill col-md-6">
            <?= $this->render('_workingtime', [
                'model' => $model,
                'workingtimeProvider' => $workingtimeProvider,
                'customerProvider' => $customerProvider,
            ]) ?>
        </div>

</div>
