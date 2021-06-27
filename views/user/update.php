<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Working on User: ' . $model->name.'-'.$model->email;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$session = Yii::$app->session;
$role = $session->get('userRole');
if ($role == 2)
{
    $this->context->layout = 'main-user';
}
else
{
    $this->context->layout = 'main';
}


?>
<div class="row">


    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-12 card bg-light text-black ">
        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        </br>
        <ul class="list-inline">
            <li class="list-inline-item"><?= Html::a('Create User', ['create'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Inactive Users', ['user/inactiveusers'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
        </ul>


    </div>
    </br>

    <div class="user-update col-md-12">
    </br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>

</div>
</div>