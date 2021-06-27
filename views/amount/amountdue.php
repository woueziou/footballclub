<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Payment */
/* @var $model app\models\Amount */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments Due for '. \Yii::$app->user->identity->name;
$this->params['breadcrumbs'][] =['label' => 'Payments', 'url' => ['index']];
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
        <h1 class="h3 mb-0 text-gray-800">Payments Actions</h1>
        </br>
        <ul class="list-inline">
            <li class="list-inline-item"><?= Html::a('Completed Payments', ['completed'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Pending Payments', ['pending'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>
            <li class="list-inline-item"><?= Html::a('Process a Payment', ['userprocess'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?></li>

        </ul>
    </div>
    </br>
    </br>
    <h1><?= Html::encode($this->title) ?></h1>

    </br>

    <div class="col-sm-11">
        </br>
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                        <tr role="row">
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 161px;">Motif</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 248px;">Period</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 114px;">Category</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 51px;">Amount</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 108px;">Tax</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 97px;">Date</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 97px;">Action</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">Motif</th>
                            <th rowspan="1" colspan="1">Period</th>
                            <th rowspan="1" colspan="1">Category</th>
                            <th rowspan="1" colspan="1">Amount</th>
                            <th rowspan="1" colspan="1">Tax</th>
                            <th rowspan="1" colspan="1">Date</th>
                            <th rowspan="1" colspan="1">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php

                        if (!(count($ppending)) == 0)
                        {
                            foreach ($ppending as $amountDue) {
                                echo '<tr class="even">'.
                                    '<td>'."{$amountDue['mlabel']}".'</td>'.
                                    '<td>'."{$amountDue['plabel']}".'</td>'.
                                    '<td>'."{$amountDue['clabel']}".'</td>'.
                                    '<td class="sort-numerical">'."{$amountDue['value']}".'</td>'.
                                    '<td>'."{$amountDue['tax']}".'</td>'.
                                    '<td>'."{$amountDue['create_at']}".'</td>'.

                                    '<td>'.'<a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="/amount/update?id='."{$amountDue['id']}".'">Process Payment</a>'.'</td>'.
                                    '</tr>';
                            };
                        }
                        else
                        {
                            echo '<tr><td><a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" >No Payments due</a></td></tr>';

                        }


                        ?>
                        </tbody>
                    </table></div></div>
        </div>


    </div>
