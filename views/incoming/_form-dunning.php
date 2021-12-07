<?php

use app\models\Incoming;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incoming */
/* @var $form yii\widgets\ActiveForm */
/* @var $userProvider \yii\data\ActiveDataProvider */
/* @var $update bool */
$disabled = !$update;
$users = $userProvider->getModels();
?>

<div class="incoming-form">
    <?= $form->field($model, 'duid')->textInput(['disabled' => $disabled]) ?>

    <?= $form->field($model, 'dunning_text1')->textarea(['rows' => 6, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'dunning_text2')->textarea(['rows' => 6, 'disabled' => $disabled]) ?>

    <?= $form->field($model, 'dunning_text3')->textarea(['rows' => 6, 'disabled' => $disabled]) ?>

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
