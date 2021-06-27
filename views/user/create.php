<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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

    <div class="col-md-12 card bg-light text-black ">
        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        </br>
        <ul class="list-inline">
            <li class="list-inline-item"><?= Html::a('Create User', ['create'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Inactive Users', ['user/inactiveusers'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
        </ul>


    </div>
    </br>

</div>

<div class="user-create col-md-11">

    </br>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
