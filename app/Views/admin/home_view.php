<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<section class="content">
    <div class="container-fluid">
        <h4>Order Overview</h4>
        <div class="row">
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= thousandsCurrencyFormat($total_order) ?></h3>

                        <p>Total Order</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= admin_url('/order') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= thousandsCurrencyFormat($order_done) ?></h3>

                        <p>Order done</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <a href="<?= admin_url('/order/done') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= thousandsCurrencyFormat($order_waiting) ?></h3>

                        <p>Order Waiting</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <a href="<?= admin_url('/order/waiting') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= thousandsCurrencyFormat($order_process) ?></h3>

                        <p>Order Process</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <a href="<?= admin_url('/order/process') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= thousandsCurrencyFormat($order_shipped) ?></h3>

                        <p>Order Shipped</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <a href="<?= admin_url('/order/shipped') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= thousandsCurrencyFormat($order_reject) ?></h3>

                        <p>Order Reject</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times"></i>
                    </div>
                    <a href="<?= admin_url('/order/reject') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $count_all['brand'] ?></h3>

                        <p>Brands</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-grid"></i>
                    </div>
                    <a href="<?= admin_url("/brands") ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <h4>Overview</h4>
        <div class="row">
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3><?= $count_all['categories'] ?></h3>

                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-grid"></i>
                    </div>
                    <a href="<?= admin_url("/categories") ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-indigo">
                    <div class="inner">
                        <h3><?= $count_all['tags'] ?></h3>

                        <p>Tags</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-grid"></i>
                    </div>
                    <a href="<?= admin_url("/tags") ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-lightblue">
                    <div class="inner">
                        <h3><?= $count_all['slider'] ?></h3>

                        <p>Sliders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-image"></i>
                    </div>
                    <a href="<?= admin_url("/slider") ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-lime">
                    <div class="inner">
                        <h3><?= $count_all['banner'] ?></h3>

                        <p>Banners</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-image"></i>
                    </div>
                    <a href="<?= admin_url("/banner") ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?= $count_all['offer'] ?></h3>

                        <p>Special Offers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-image"></i>
                    </div>
                    <a href="<?= admin_url("/offer") ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $count_all['users'] ?></h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?= admin_url('/report/user_regis') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= thousandsCurrencyFormat($total_visitor) ?></h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Online Store Visitors</h3>
                                    <a href="<?= admin_url('/report/visitor') ?>">View Report</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg"><?= thousandsCurrencyFormat($detail_visitor['total_thisweek']) ?></span>
                                        <span>Visitors Over Time</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <?php if ($detail_visitor['increase_perweek'] > $detail_visitor['decrease_perweek']) : ?>
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i> <?= $detail_visitor['increase_perweek'] ?>%
                                            </span>
                                        <?php else : ?>
                                            <span class="text-danger">
                                                <i class="fas fa-arrow-down"></i> <?= $detail_visitor['decrease_perweek'] ?>%
                                            </span>
                                        <?php endif ?>
                                        <span class="text-muted">Since last week</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="visitors-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> This Week
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last Week
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($latest_order as $lo) : ?>
                                                <tr>
                                                    <td><a href="<?= admin_url('/order/view/' . $lo->token) ?>"><?= $lo->token ?></a></td>
                                                    <?php if ($lo->status == "WAITING") : ?>
                                                        <td><span class="badge badge-warning"><?= $lo->status ?></span></td>
                                                    <?php elseif ($lo->status == "PROCESS") : ?>
                                                        <td><span class="badge badge-info"><?= $lo->status ?></span></td>
                                                    <?php elseif ($lo->status == "SHIPPED") : ?>
                                                        <td><span class="badge badge-success"><?= $lo->status ?></span></td>
                                                    <?php elseif ($lo->status == "DONE") : ?>
                                                        <td><span class="badge badge-primary"><?= $lo->status ?></span></td>
                                                    <?php elseif ($lo->status == "REJECT") : ?>
                                                        <td><span class="badge badge-danger"><?= $lo->status ?></span></td>
                                                    <?php endif ?>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="<?= admin_url('/order') ?>" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Sales</h3>
                                    <a href="<?= admin_url("/report") ?>">View Report</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">Rp.<?= thousandsCurrencyFormat($report_sales['total_this_year']) ?></span>
                                        <span>Sales Over Time</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <?php if ($report_sales['increase_permonth'] > $report_sales['decrease_permonth']) : ?>
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i> <?= $report_sales['increase_permonth'] ?>%
                                            </span>
                                        <?php else : ?>
                                            <span class="text-danger">
                                                <i class="fas fa-arrow-down"></i> <?= $report_sales['decrease_permonth'] ?>%
                                            </span>
                                        <?php endif ?>
                                        <span class="text-muted">Since last month</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> This year
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last year
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>

</section>
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>
    $(document).ready(function() {
        $('.dropdown-submenu a.test').on("click", function(e) {
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
    /* global Chart:false */

    $(function() {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart')
        // eslint-disable-next-line no-unused-vars
        $.get({
            url: "<?= admin_url("/api/home/getsales_today") ?>",
            success: (data) => {
                var salesChart = new Chart($salesChart, {
                    type: 'bar',
                    data: {
                        labels: data.key,
                        datasets: [{
                                backgroundColor: '#007bff',
                                borderColor: '#007bff',
                                data: data.this_year
                            },
                            {
                                backgroundColor: '#ced4da',
                                borderColor: '#ced4da',
                                data: data.last_year
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,

                                    // Include a dollar sign in the ticks
                                    callback: function(value) {
                                        if (value >= 1000) {
                                            value /= 1000
                                            value += 'k'
                                        }

                                        return 'Rp.' + value
                                    }
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })
            }
        })

        var $visitorsChart = $('#visitors-chart')
        // eslint-disable-next-line no-unused-vars
        $.get({
            url: "<?= admin_url("/api/home/getvisitor_today") ?>",
            success: (data) => {
                var visitorsChart = new Chart($visitorsChart, {
                    data: {
                        labels: data.keys,
                        datasets: [{
                                type: 'line',
                                data: data.this_week,
                                backgroundColor: 'transparent',
                                borderColor: '#007bff',
                                pointBorderColor: '#007bff',
                                pointBackgroundColor: '#007bff',
                                fill: false
                                // pointHoverBackgroundColor: '#007bff',
                                // pointHoverBorderColor    : '#007bff'
                            },
                            {
                                type: 'line',
                                data: data.last_week,
                                backgroundColor: 'tansparent',
                                borderColor: '#ced4da',
                                pointBorderColor: '#ced4da',
                                pointBackgroundColor: '#ced4da',
                                fill: false
                                // pointHoverBackgroundColor: '#ced4da',
                                // pointHoverBorderColor    : '#ced4da'
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                    suggestedMax: 200
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })
            }
        })
    })

    // lgtm [js/unused-local-variable]
</script>
<?= $this->endSection() ?>