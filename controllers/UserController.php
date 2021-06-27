<?php

namespace app\controllers;

use app\models\InactiveUserSearch;
use app\models\Usercategory;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $userRole = User::findOne([
            'id'=>$id,
        ]);

        if ($userRole->ROLE <> 1)
        {
            if ($userRole->ROLE == 2)
            {
                return $this->render('userview', [
                    'model' => $this->findModel($id),
                    'role' => $userRole->ROLE,
                ]);
            }
            else
            {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                    'role' => $userRole->ROLE,
                ]);
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //getting newly created user id
            $idUser = $model->id ;

            $userCategory = new Usercategory();

            $userCategory->USER = $idUser;
            $userCategory->CATEGORY = $model->CATEGORY;

            $userCategory->save();
            // sending mail to user to advice him for new created account
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $userRole = User::findOne([
            'id'=>$id,
        ]);

        $sess = Yii::$app->session;
        $role = $sess->get('userRole');


                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    //Modifier la table usercategorie

                    $CurUserCat = Usercategory::find()
                    ->where(['not','CATEGORY=1'])
                    ->where(['USER'=>$model->id]);

                    $CurUserCatCount = Usercategory::find()
                        ->where(['not','CATEGORY=1'])
                        ->where(['USER'=>$model->id])
                        ->count();

                    if ($CurUserCatCount = 0)
                    {
                        $userCat = new Usercategory();
                        $userCat->USER = $model->id ;
                        $userCat->CATEGORY = $model->CATEGORY;
                        $userCat->save(false);
                    }
                    else
                    {
                        $CurUserCat->USER = $model->id ;
                        $CurUserCat->CATEGORY = $model->CATEGORY;
                        $CurUserCat->save(false);
                    }


                    if ($role == 2) {
                        return $this->redirect(['userview', 'id' => $model->id]);
                    }
                    else
                    {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

                if ($role == 2) {
                    return $this->render('userupdate', [
                        'model' => $model,
                    ]);
                }
                else
                {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }



    /**
     *
     *
     */

    public function actionUserupdate($id)
    {
        $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['userview', 'id' => $model->id]);
            }

            return $this->render('userupdate', [
                'model' => $model,
            ]);
    }



    /**
     * Deletes an existing User model.
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

    public function actionInactiveusers()
    {

        $inactiv = new User();
        $users = [];

        $users = $inactiv->GetInactiveUsers();

        if ($users === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('inactiveUsers', [
            'users' => $users,
        ]);

    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
