<?php

namespace app\controllers;

use app\models\Customer;
use app\models\CustomerSearch;
use app\models\Incoming;
use app\models\IncomingSearch;
use app\models\PrintPdf;
use app\models\UserSearch;
use app\models\Workingtime;
use app\models\WorkingtimeSearch;
use http\Exception;
use yii\base\BaseObject;
use yii\data\DataFilter;
use yii\db\ActiveRecord;
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
        return $this->actionUpdate($id, false);

        /* return $this->render('view', [
            'model' => $this->findModel($id),
        ]); */
    }

    /**
     * Creates a new Incoming model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Incoming();
        if (!$this->request->isPost) {
            // exception, that no workingtime entries where selected
            // $model->loadDefaultValues(); // ??
        }

        // saving created invoice for the forst time => then got to create
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            // generate entry and redirect to update
            return $this->actionUpdate($model->id);
        }

        // get ids of selected workingtimes
        $WorkingtimeSearch = $this->request->post('WorkingtimeSearch');
        // retrieve data from hidden text field
        $selectedIds = array_filter(explode(',', $this->request->getBodyParam('selectedIds', '')));
        if (0 === count($selectedIds)) $selectedIds = ['noIdSelected'];

        // generate values to be used later on
        $workingtimeModels = new WorkingtimeSearch();
        $customerId = $WorkingtimeSearch['customer_company'] ?? null;
        $customerModel = Customer::findOne($customerId);
        $minutes = (int) $workingtimeModels->sumUpMinutes(['WorkingtimeIds' => $selectedIds]);
        $hours = $minutes / 60;
        $goods_sales = (float) ($customerModel->salary ?? null) * (float) $hours;
        $tax_value = 0; // steuersatz
        $sales_tax = $goods_sales * $tax_value; // steuerbetrag
        $gross = $goods_sales + $sales_tax; // gesamter abzurechnender betrag

        // these values will be displayed when invoice us first loaded
        $model->setAttribute('cid', $customerModel->id);
        $model->setAttribute('invoice_date', date('Y-m-d'));
        $model->setAttribute('last_update', date('Y-m-d H:i:s'));
        $model->setAttribute('create_date', date('Y-m-d H:i:s'));
        $model->setAttribute('gross', $gross);
        $model->setAttribute('tax_value', $tax_value);
        $model->setAttribute('sales_tax', $sales_tax);
        $model->setAttribute('goods_sales', $goods_sales);

        // generate models for select boxes in view
        $customerModels = new CustomerSearch();
        $customerProvider = $customerModels->search(['CustomerOptions' => ['status' => 1]]);
        $customerProvider->getPagination()->setPageSize(0);

        $userModels = new UserSearch();
        $userProvider = $userModels->search([]);

        $workingtimeModels = new WorkingtimeSearch();
        $workingtimeProvider = $workingtimeModels->search(['WorkingtimeIds' => $selectedIds]);
        $workingtimeProvider->getPagination()->setPageSize(0);

        return $this->render('create', [
            'model' => $model,
            'customerProvider' => $customerProvider,
            'workingtimeProvider' => $workingtimeProvider,
            'userProvider' => $userProvider,
            'update' => true,
        ]);
    }

    /**
     * Updates an existing Incoming model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $update = true)
    {
        $model = $this->findModel($id);

        $selectedIds = $this->request->getBodyParam('selection', []);
        if (0 === count($selectedIds)) $selectedIds = ['impossibleIdToCReateAnEmptyResult'];

        // saving the transferred datra
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->setAttribute('last_update', date('Y-m-d H:i:s'));

            $workingtimeModels = new WorkingtimeSearch();
            $workingtimeProvider = $workingtimeModels->search(['invoice_number' => $model->id]);
            /** @var $workingtime Workingtime */

            foreach ($workingtimeProvider->getModels() as $workingtime) {
                $invoice_id = in_array($workingtime->id, $selectedIds) ? $model->id : 0;
                $workingtime->setAttribute('invoice_number', $invoice_id);
                $workingtime->save(false);
            }
            // return $this->redirect(['view', 'id' => $model->id]);

            if ($model->save()) return $this->redirect(['view', 'id' => $model->id]);
            else die('Something went wrong while saving ... and yes, this should be an exception');
        }

        // displaying data
        // for loading from database
        if (is_numeric($id) && 0 < $id) {
            $workingtimeSearch = new WorkingtimeSearch();
            $workingtimeProvider = $workingtimeSearch->search(['invoice_number' => $id]);
        } else {
            // retrieving data from form
            $workingtimeModels = new WorkingtimeSearch();
            $workingtimeProvider = $workingtimeModels->search(['WorkingtimeIds' => $selectedIds]);
        }
        $workingtimeProvider->getPagination()->setPageSize(0);

        // generate models for select boxes in view
        $customerModels = new CustomerSearch();
        $customerProvider = $customerModels->search(['CustomerOptions' => ['status' => 1]]);
        $customerProvider->getPagination()->setPageSize(0);

        $userModels = new UserSearch();
        $userProvider = $userModels->search([]);

        return $this->render('update', [
            'model' => $model,
            'customerProvider' => $customerProvider,
            'workingtimeProvider' => $workingtimeProvider,
            'userProvider' => $userProvider,
            'update' => $update,
        ]);
    }

    /**
     * Print an Invoice
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPrint($id, $update = true)
    {
        $incoming = $this->findModel($id);
        $customer = Customer::findOne($incoming->cid);
        $printer = new PrintPdf();
        $printer->setCustomer($customer);
        $printer->setInvoiceNumber($incoming->identifier);
        $printer->setInvoiceDate($incoming->invoice_date);
        $printer->generate($incoming->invoice_text);
        return $this->actionUpdate($id, $update);
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
