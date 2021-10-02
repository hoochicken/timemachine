<?php

namespace app\controllers;

class WorkingtimeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionForm()
    {
        return $this->render('form');
    }

}
