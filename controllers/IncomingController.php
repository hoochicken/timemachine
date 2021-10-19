<?php

namespace app\controllers;

use app\models\Customer;
use app\models\CustomerSearch;
use app\models\Incoming;
use app\models\IncomingSearch;
use app\models\WorkingtimeSearch;
use yii\base\BaseObject;
use yii\data\DataFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IncomingController implements the CRUD actions for Incoming model.
 */
class IncomingController extends Controller
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
     * Lists all Incoming models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncomingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $customerModels = new CustomerSearch();
        $customerProvider = $customerModels->search(['CustomerOptions' => ['status' => 1]]);
        $customerProvider->getPagination()->setPageSize(0);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'customerProvider' => $customerProvider,
        ]);
    }

    /**
     * Displays a single Incoming model.
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
     * Creates a new Incoming model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Incoming();

        $WorkingtimeSearch = $this->request->post('WorkingtimeSearch');

        $customerId = $WorkingtimeSearch['customer_company'] ?? null;
        $customerModel = Customer::findOne($customerId);

        $customerModels = new CustomerSearch();
        $customerProvider = $customerModels->search(['CustomerOptions' => ['status' => 1]]);
        $customerProvider->getPagination()->setPageSize(0);

        $workingtimeModels = new WorkingtimeSearch();

        $workingtimeProvider = $workingtimeModels->search(['WorkingtimeIds' => array_filter(explode(',', $this->request->getBodyParam('selectedIds', '')))]);
        $workingtimeProvider->getPagination()->setPageSize(0);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $model->setAttribute('cid', $customerId);
            $model->setAttribute('invoice_date', date('Y-m-d H:i:s'));
            if (false) {
                $model->setAttribute('customer_id', $customerId);
                $model->setAttribute('customer_company', $customerModel->company);
                $model->setAttribute('customer_surname', $customerModel->surname);
                $model->setAttribute('customer_name', $customerModel->name);
                $model->setAttribute('customer_addendum', $customerModel->addendum);
                $model->setAttribute('customer_street', $customerModel->street);
                $model->setAttribute('customer_postcode', $customerModel->postcode);
                $model->setAttribute('customer_city', $customerModel->city);
                $model->setAttribute('customer_country', $customerModel->country);
                $model->setAttribute('customer_salary', $customerModel->salary);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'customerProvider' => $customerProvider,
            'workingtimeProvider' => $workingtimeProvider,
        ]);
    }

    /**
     * Updates an existing Incoming model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Incoming model.
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
     * Finds the Incoming model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Incoming the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Incoming::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
