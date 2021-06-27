<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Payment */
/* @var $model app\models\Amount */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments Completed for '. \Yii::$app->user->identity->name;
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

    <h1><?= Html::encode($this->title) ?></h1>
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

    <div class="col-sm-11">

        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
            <tr role="row">
                <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 161px;">Amount To Pay</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 248px;">Tax Amount</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 114px;">Initiation date</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 51px;">Payment purpose</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 108px;">Status</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 97px;"></th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 97px;">Action</th>

            </tr>
            </thead>
            <tbody>
            <?php

            if (!(count($allAmountCompleted)) == 0)
            {
                foreach ($allAmountCompleted as $amountComplete) {
                    echo '<tr class="odd">'.
                        '<td class="sort-numerical">'."$amountComplete->value".'</td>'.
                        '<td>'  ."$amountComplete->tax".'</td>'.
                        '<td>'."$amountComplete->create_at".'</td>'.
                        '<td>'."$amountComplete->PAYMENT".'</td>'.
                        '<td>'."$amountComplete->status".'</td>'.
                        '<td>'.'</td>'.
                        '<td>'.'<a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="/amount/view?id='.$amountDue->PAYMENT.'">View Payment</a>'.'</td>'.
                        '</tr>';
                };
            }
            else
            {
                echo '<tr><td><a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" >No User To activate</a></td></tr>';

            }


            ?>



            </tbody>




        </table></div></div>


</div>
