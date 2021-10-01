<?php

namespace app\Controllers;

class CustomerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
