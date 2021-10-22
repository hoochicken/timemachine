<?php

use app\models\Workingtime;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkingtimeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $customerProvider yii\data\ActiveDataProvider */

$customers = $customerProvider->getModels();

$this->title = 'Workingtimes';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">
    function stack(eventTrigger) {
        let ids = $('#w0').yiiGridView('getSelectedRows');
        $('#selectedIds').val(ids);
        if ('' === $('#workingtimesearch-customer_company').val()) {
            alert('Bitte Kunden für die Rechnung angeben');
            return false;
        }
        if ('' === $('#selectedIds').val()) {
            alert('Bitte abzurechnende Positionen bestimmen');
            return false;
        }
        $('#postToInvoice').submit();
        return true;
    }
</script>
<div class="workingtime-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Workingtime', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::beginForm('/index.php?r=incoming%2Fcreate', 'post', ['id' => 'postToInvoice']) ?>
        <?= Html::button('Rechnung stellen', ['onclick' => 'javascript:stack();', 'class' => 'btn btn-info']) ?>
        <?= Html::hiddenInput('selectedIds', '', ['class' => 'btn btn-info', 'id' => 'selectedIds']) ?>
        <?php /* todo => das searchmodel bewirkt, dass der name/id des fields WorkingtimeSearch[] ist
        und das erzeugt im Backend den hässlichen Hack; das muss man irgendwann ausbauen
         */ ?>
        <?= Html::activeDropDownList(
            $searchModel,
            'customer_company',
            ArrayHelper::map($customers, 'id', 'company'),
            ['class'=>'form-control', 'prompt' => '']
        ) ?>
        <?= Html::endForm() ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            // 'cid',
            'customer_company' =>
                [
                    'label' => 'Kunde (Id)',
                    'format' => 'ntext',
                    'attribute' =>'customer_company',
                    'value' => function($model) {
                        return $model->customer_company;
                    },
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'customer_company',
                        ArrayHelper::map($customers, 'id', 'company'),
                            ['class'=>'form-control', 'prompt' => '']
                    )
                ],
            'description:ntext',
            'minutes' => [
                'attribute' =>'minutes',
                'footer' => round(array_sum(array_map(function($item) {
                return $item->minutes;
                }, $dataProvider->getModels())) / 60, 2) . ' h'
            ],
            'date',
            'status' =>
                [
                    'label' => 'Status',
                    'attribute'=>'status',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status', ['all' => 'alle', Workingtime::STATE_OPEN => 'open', Workingtime::STATE_DONE => 'abgerechnet', Workingtime::STATE_UNKNOWN => 'unbekannte 15'],
                        ['class'=>'form-control', 'prompt' => '']
                    )
                ],
            'invoice_number',
            'checker' => [
                'class' => 'yii\grid\CheckboxColumn',
                // you may configure additional properties here
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>



</div>

