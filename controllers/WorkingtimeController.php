<?php

namespace app\controllers;

use app\models\Customer;
use app\models\CustomerSearch;
use app\models\Workingtime;
use app\models\WorkingtimeSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkingtimeController implements the CRUD actions for Workingtime model.
 */
class WorkingtimeController extends Controller
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
     * Lists all Workingtime models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = $this->request->queryParams;
        if (!isset($params['WorkingtimeSearch']) || 0 === count($params['WorkingtimeSearch'])) {
            $params['WorkingtimeSearch'] = ['invoice_number' => '0'];
        }

        $searchModel = new WorkingtimeSearch();
        $dataProvider = $searchModel->search($params['WorkingtimeSearch'] ?? []);

        $customerModel = new CustomerSearch();
        $customerProvider = $customerModel->search(['CustomerOptions' => ['status' => 1]]);
        $customerProvider->getPagination()->setPageSize(0);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'customerProvider' => $customerProvider,
        ]);
    }

    /**
     * Displays a single Workingtime model.
     * @param int $id
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
     * Creates a new Workingtime model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Workingtime();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
    }

    /**
     * Updates an existing Workingtime model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $customerModel = new CustomerSearch();
        $customerProvider = $customerModel->search(['CustomerOptions' => ['status' => 1]]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'customerProvider' => $customerProvider,
        ]);
    }

    /**
     * Deletes an existing Workingtime model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Workingtime model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Workingtime the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workingtime::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
