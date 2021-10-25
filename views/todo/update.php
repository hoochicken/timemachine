<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Todo */
/* @var $customerProvider \yii\data\ActiveDataProvider */

$this->title = 'Todo > Update: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Todos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="todo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'customerProvider' => $customerProvider,
    ]) ?>

</div>
