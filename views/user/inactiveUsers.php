<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Inactive Users';
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
<div class="user-index col-md-11">
    </br>
    <h1><?= Html::encode($this->title) ?></h1>

       <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="col-sm-12">

        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
            <tr role="row">
                <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 161px;">Id</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 248px;">Name</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 114px;">Email</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 51px;">Username</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 108px;">Subscription date</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 97px;">Status</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 97px;">Action</th>

            </tr>
            </thead>
            <tbody>
            <?php
            if (!(count($users)) == 0)
            {
            foreach ($users as $user) {
                echo '<tr class="odd">'.
                    '<td class="sort-numerical">'."$user->id".'</td>'.
                    '<td>'  ."$user->name".'</td>'.
                    '<td>'."$user->email".'</td>'.
                    '<td>'."$user->username".'</td>'.
                    '<td>'.'</td>'.
                    '<td>'.'</td>'.
                    '<td>'.'<a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="/user/update?id='.$user->id.'">Activate</a>'.'</td>'.
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
</div>