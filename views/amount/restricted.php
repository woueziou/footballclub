<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Amount */

$this->title = "Restricted Area - Please contact admin";
$this->params['breadcrumbs'][] = ['label' => 'Amounts', 'url' => ['index']];
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
<div class="amount-view row">
 <div class="col-md-12">
    <h1><?= Html::encode($this->title) ?></h1>
 </div>
</div>
