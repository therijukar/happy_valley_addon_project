<?php
/* @var $this yii\web\View */
$session = Yii::$app->session;
?>


    <style>

    .card-1 {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .card-1:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }
</style>



    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li class="active">
                    <strong>Dashboard</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <!-- start: page -->

<div class="wrapper wrapper-content" style="height: 500px;">
    <div class="row">
        <div class="col-sm-3 ">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Active</span>
                    <h5>Tickets</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $ticket; ?></h1>
                    <small>Total</small>
                </div>
            </div>
        </div>



        <div class="col-lg-3 ">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Active</span>
                    <h5>Restaurant</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $restaurant; ?></h1>
                    <small>Total</small>
                </div>
            </div>
        </div>


        <div class="col-lg-3 ">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Active</span>
                    <h5>Banquet</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $banquet; ?></h1>
                    <small>Total</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3 ">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title">
                    <span class="label label-danger pull-right">Active</span>
                    <h5>Picnic Spots</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $picnic_spots; ?></h1>
                    <small>Total</small>
                </div>
            </div>
        </div>
    <div style="margin-bottom: 30px;">
        <div class="row items-center">
            <div class="col-sm-6">
                <h3 class="font-bold no-margins">Sales Analytics</h3>
                <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
                    <a href="?period=<?php echo $period; ?>&steps=<?php echo $prevStep; ?>" class="btn btn-white btn-sm px-3 shadow-sm"><i class="fa fa-chevron-left"></i></a>
                    <span class="h4 m-0 font-bold text-primary" style="min-width: 150px; text-align: center;"><?php echo $periodTitle; ?></span>
                    <?php if($steps > 0): ?>
                    <a href="?period=<?php echo $period; ?>&steps=<?php echo $nextStep; ?>" class="btn btn-white btn-sm px-3 shadow-sm"><i class="fa fa-chevron-right"></i></a>
                    <?php else: ?>
                    <button class="btn btn-white btn-sm px-3 shadow-sm" disabled><i class="fa fa-chevron-right text-muted"></i></button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6 text-right">
                <div class="btn-group shadow-sm">
                    <a href="?period=week" class="btn btn-sm <?php echo $period=='week'?'btn-primary':'btn-white'; ?>">Week</a>
                    <a href="?period=month" class="btn btn-sm <?php echo $period=='month'?'btn-primary':'btn-white'; ?>">Month</a>
                    <a href="?period=year" class="btn btn-sm <?php echo $period=='year'?'btn-primary':'btn-white'; ?>">Year</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title">
                    <span class="label label-primary pull-right"><?php echo $periodTitle; ?></span>
                    <h5>Revenue</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins text-success">₹<?php echo number_format($periodRevenue); ?></h1>
                    <small>Earnings (<?php echo $periodTitle; ?>)</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Total</span>
                    <h5>Tickets Sold</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($periodCount); ?></h1>
                    <small>In <?php echo $periodTitle; ?></small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title">
                    <span class="label label-warning pull-right">Avg</span>
                    <h5>Average Sales</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $avgSales; ?></h1>
                    <small><?php echo $avgLabel; ?></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title">
                    <h5>Ticket Sales Trend (<?php echo $periodTitle; ?>)</h5>
                </div>
                <div class="ibox-content">
                    <div style="height: 300px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(Yii::$app->request->get('debug')): ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title"><h5>Debug Data (Recent 20)</h5></div>
                <div class="ibox-content">
                    <table class="table table-bordered">
                        <thead><tr><th>ID</th><th>Ticket No</th><th>Amt</th><th>Created Date</th><th>Visit Date</th><th>Active</th><th>Deleted</th></tr></thead>
                        <tbody>
                        <?php 
                        $debugRows = (new \yii\db\Query())
                            ->from('booking')
                            ->orderBy(['id' => SORT_DESC])
                            ->limit(20)
                            ->all();
                        foreach($debugRows as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['ticket_no'] ?></td>
                                <td><?= $row['amount'] ?></td>
                                <td><?= $row['created_date'] ?></td>
                                <td><?= $row['date'] ?></td>
                                <td><?= $row['is_active'] ?></td>
                                <td><?= $row['soft_delete'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div style="margin-bottom:100px"></div>
</div>

<!-- Chart.js CDN (Legacy Stable v2.9.4) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    $(document).ready(function() {
        var ctx = document.getElementById("salesChart").getContext("2d");
        var salesData = <?php echo $chartValues; ?>;
        var salesLabels = <?php echo $chartLabels; ?>;
        
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: "Tickets Sold",
                    data: salesData,
                    backgroundColor: "rgba(26, 179, 148, 0.2)",
                    borderColor: "rgba(26, 179, 148, 1)",
                    pointBackgroundColor: "#fff",
                    pointBorderColor: "rgba(26, 179, 148, 1)",
                    pointRadius: 4,
                    borderWidth: 2,
                    fill: false,
                    lineTension: 0.2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { display: false },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    xAxes: [{
                        gridLines: { display: false }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "#f3f3f3",
                            zeroLineColor: "#f3f3f3",
                            drawBorder: false
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
    });
</script>
