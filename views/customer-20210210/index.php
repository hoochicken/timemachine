<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */

use yii\widgets\ListView;

?>
<h1>customer/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_form',
    ]);
    ?>
</p>
