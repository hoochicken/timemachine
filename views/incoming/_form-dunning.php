<?php

use app\models\Incoming;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $form yii\widgets\ActiveForm */
/* @var $userProvider \yii\data\ActiveDataProvider */
$users = $userProvider->getModels();
?>

<div class="incoming-form">
    <?= $form->field($model, 'duid')->textInput() ?>

    <?= $form->field($model, 'dunning_text1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dunning_text2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dunning_text3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
