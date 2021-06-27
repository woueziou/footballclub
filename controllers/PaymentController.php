<?php

namespace app\controllers;

use app\models\Amount;
use app\models\User;
use app\models\Usercategory;
use app\models\UserPaymentSearch;
use Yii;
use app\models\Payment;
use app\models\PaymentSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentController implements the CRUD actions for Payment model.
 */
class PaymentController extends Controller
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
     * Lists all Payment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payment model.
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
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payment();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                //Getting saved Payment id
                $idPayment = $model->id;
                $flag = true ;
                //Getting concerned users category
                $idCategory = $model->category;
                //Retrieving concerned users for current payment

                $concernedUsers = Usercategory::find()
                    ->select('USER')
                    ->where(['CATEGORY' => $idCategory])
                    ->asArray()
                    ->all();

                //Affecting amount due to concerned users
                $count = 0;

                if (is_array($concernedUsers) && count($concernedUsers) > 0) {
                    foreach ($concernedUsers as $concernedUser) {

                        $amountDue = new Amount();

                        $amountDue->PAYMENT = $idPayment;
                        $amountDue->tax = 0;
                        $amountDue->value = $model->amountvalue;
                        $amountDue->USER = $concernedUser['USER'];
                        $amountDue->create_at = date("Y-m-d H:i:s");

                        if ($amountDue->save(false)){

                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        return $this->render('create', [
            'model' => $model,
        ]);

    }






    /**
     * Updates an existing Payment model.
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
     * Deletes an existing Payment model.
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
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}

