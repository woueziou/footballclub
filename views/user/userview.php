<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

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
?>
<div class="row">

    <div class="col-md-12">
        </br>
    <h1><?= Html::encode($this->title) ?>

    </h1>

    </div>
    <div class="user-view col-md-11">
        </br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'name',
            'othername',
            'email:email',
            'phone',
            'address',
            'username',
            'ROLE',
        ],
    ]) ?>

        <p><?= Html::a('Update Current User', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>
    </div>
</div>
