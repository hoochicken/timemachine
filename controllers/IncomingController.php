<?php

namespace app\controllers;

use app\models\Customer;
use app\models\CustomerSearch;
use app\models\Incoming;
use app\models\IncomingSearch;
use app\models\UserSearch;
use app\models\WorkingtimeSearch;
use http\Exception;
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
        $selectedIds = array_filter(explode(',', $this->request->getBodyParam('selectedIds', '')));
        // @todo this is a hock ... i should not do that!!! to be fixed
        if (0 === count($selectedIds)) $selectedIds = ['noIdSelected'];

        $customerId = $WorkingtimeSearch['customer_company'] ?? null;
        $customerModel = Customer::findOne($customerId);

        $customerModels = new CustomerSearch();
        $customerProvider = $customerModels->search(['CustomerOptions' => ['status' => 1]]);
        $customerProvider->getPagination()->setPageSize(0);

        $workingtimeModels = new WorkingtimeSearch();
        $workingtimeProvider = $workingtimeModels->search(['WorkingtimeIds' => $selectedIds]);
        $workingtimeProvider->getPagination()->setPageSize(0);

        $userModels = new UserSearch();
        $userProvider = $userModels->search([]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $model->setAttribute('last_update', date('Y-m-d H:i:s'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $model->setAttribute('cid', $customerId);
            $model->setAttribute('invoice_date', date('Y-m-d'));
            $model->setAttribute('last_update', date('Y-m-d H:i:s'));
            $model->setAttribute('create_date', date('Y-m-d H:i:s'));

            $minutes = $workingtimeModels->sumUpMinutes(['WorkingtimeIds' => $selectedIds]);

            $goods_sales = (float) $customerModel->salary * (float) $minutes;
            $tax_value = 0; // steuersatz
            $sales_tax = $goods_sales * $tax_value; // steuerbetrag
            $gross = $goods_sales + $sales_tax; // gesamter abzurechnender betrag

            $model->setAttribute('minutes_original', $minutes);
            $model->setAttribute('minutes', $minutes);
            $model->setAttribute('gross', $gross);
            $model->setAttribute('tax_value', $tax_value);
            $model->setAttribute('sales_tax', $sales_tax);
            $model->setAttribute('goods_sales', $goods_sales);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'customerProvider' => $customerProvider,
            'workingtimeProvider' => $workingtimeProvider,
            'userProvider' => $userProvider,
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
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->setAttribute('last_update', date('Y-m-d H:i:s'));
            if ($model->save()) return $this->redirect(['view', 'id' => $model->id]);
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
