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


    <div class="user-update col-md-12">
    </br>
    <?= $this->render('_userform', [
        'model' => $model,
    ]) ?>
    </div>

</div>
</div>