<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Todo */
/* @var $customerProvider \yii\data\ActiveDataProvider */

$this->title = 'Todo > Create';
$this->params['breadcrumbs'][] = ['label' => 'Todos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todo-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'customerProvider' => $customerProvider,
    ]) ?>

</div>
