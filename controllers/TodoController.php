<?php

namespace app\controllers;

use app\models\CustomerSearch;
use app\models\Todo;
use app\models\TodoSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TodoController implements the CRUD actions for Todo model.
 */
class TodoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Todo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TodoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $customerModel = new CustomerSearch();
        $customerProvider = $customerModel->search(['CustomerOptions' => ['status' => 1]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'customerProvider' => $customerProvider,
        ]);
    }

    /**
     * Displays a single Todo model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Todo model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDone($id, $done = 1)
    {
        $model = $this->findModel($id);
        $model->done = $done;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Creates a new Todo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Todo();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $model->date = date('Y-m-d H:i:s');
                $model->save();

                if (1 === (int) $this->request->getBodyParam('saveAndNew')) {
                    return $this->redirect(['create']);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $customerModel = new CustomerSearch();
        $customerProvider = $customerModel->search(['CustomerOptions' => ['status' => 1]]);

        return $this->render('create', [
            'model' => $model,
            'customerProvider' => $customerProvider,
        ]);

        // return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing Todo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->id]);
        }

        $customerModel = new CustomerSearch();
        $customerProvider = $customerModel->search(['CustomerOptions' => ['status' => 1]]);

        return $this->render('update', [
            'model' => $model,
            'customerProvider' => $customerProvider,
        ]);
    }

    /**
     * Deletes an existing Todo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Todo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Todo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Todo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
