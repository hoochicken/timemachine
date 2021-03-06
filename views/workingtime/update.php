<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Workingtime */
/* @var $customerProvider ActiveDataProvider */

$this->title = 'Workingtime > Update: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Workingtimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="workingtime-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'customerProvider' => $customerProvider,
    ]) ?>

</div>
