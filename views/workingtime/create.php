<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Workingtime */
/* @var $customerProvider yii\data\ActiveDataProvider */

$this->title = 'Create Workingtime';
$this->params['breadcrumbs'][] = ['label' => 'Workingtimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workingtime-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'customerProvider' => $customerProvider,
    ]) ?>

</div>
