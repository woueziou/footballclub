<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Motif */

$this->title = 'Create Motif';
$this->params['breadcrumbs'][] = ['label' => 'Motifs', 'url' => ['index']];
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
<div class="motif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
