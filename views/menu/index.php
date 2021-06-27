<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MotifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php

$this->registerJsFile("@web/js/sb-admin-2.js", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

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

<?php $th = 'aria-valuenow="'.$totalcompleted.'" aria-valuemin="0" aria-valuemax="'.$totalpending.'"'  ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </br>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Completed payments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($completed) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Amount Paid</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalcompleted; ?></div>
                    </div>
                    <div class="col">
                        <div class="progress progress-sm mr-2">

                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" <?php echo "$th" ;?>></div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total amount Due
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $totalpending; ?></div>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Payments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($pending); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h1 class="h3 mb-0 text-gray-800">Last payments</h1>
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
    </div>
</div>
