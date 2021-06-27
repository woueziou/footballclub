<?php

namespace app\controllers;

use app\models\Payment;
use Yii;
use app\models\Amount;
use app\models\AmountSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AmountController implements the CRUD actions for Amount model.
 */
class AmountController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Amount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AmountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $session = Yii::$app->session;
        $role = $session->get('userRole');
        if ($role == 2)
        {
            return $this->render('restricted');
        }
        else {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Amount model.
     * @param integer $id
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
     * Creates a new Amount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $role = $session->get('userRole');
        if ($role == 2)
        {
            $this->layout = 'main-user';
            $this->render('restricted');
        }
        else
        {
            $model = new Amount();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    public function actionAmountdue()
    {
        $amount = new Amount();
        $allAmountDues = $amount->getAmountDuePayment();

        return $this->render('amountdue', [
            'ppending' => $allAmountDues,
        ]);
    }

    public function actionCompleted()
    {
        $amount = new Amount();
        $allAmountPaids = $amount->getAmountPaid();

        return $this->render('completed', [
            'allAmountCompleted' => $allAmountPaids,
        ]);
    }

    public function actionPending()
    {
        $amount = new Amount();
        $allAmountPending = $amount->getAmountDue();

        return $this->render('pending', [
            'ppending' => $allAmountPending,
        ]);
    }


    /**
     * Updates an existing Amount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Amount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Amount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Amount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Amount::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
