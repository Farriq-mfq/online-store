<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form action="<?= admin_url('/report/generate/product_sales/pdf?year=' . $selected_year . '&month=' . $selected_month . '') ?>" method="POST">
                    <?= csrf_field() ?>
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-print"></i>
                        Download PDF / Print
                    </button>
                </form>
                <form action="<?= admin_url("/report/product_sales") ?>" method="GET" class="mt-2">
                    <div class="form-group ">
                        <label for=""> Filter Month</label>
                        <select name="month" class="form-control <?= show_class_error('month') ?>">
                            <option value="">Select Month</option>
                            <?php foreach ($month_filter as $f) : ?>
                                <option <?php if ($f->month == $selected_month) : ?>selected<?php endif ?> value="<?= $f->month ?>"><?= $f->month ?></option>
                            <?php endforeach ?>
                        </select>
                        <?= show_error('month') ?>
                    </div>
                    <div class="form-group mt-2">
                        <label for=""> Filter Year</label>
                        <select name="year" class="form-control <?= show_class_error('year') ?>">
                            <option value="">Select Year</option>
                            <?php foreach ($year_filter as $f) : ?>
                                <option <?php if ($f->year == $selected_year) : ?>selected<?php endif ?> value="<?= $f->year ?>"><?= $f->year ?></option>
                            <?php endforeach ?>
                        </select>
                        <?= show_error('year') ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Sales</th>
                            <th>Month</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product_sales_report as $v) : ?>
                            <tr>
                                <td><?= $v['product_title'] ?></td>
                                <td><?= format_rupiah($v['price']) ?></td>
                                <td><?php if ($v['increst'] > $v['decrest']) : ?>
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i> <?= $v['increst'] ?>%
                                        </span>
                                    <?php else : ?>
                                        <span class="text-danger">
                                            <i class="fas fa-arrow-down"></i> <?= $v['decrest'] ?>%
                                        </span>
                                    <?php endif ?>
                                    <?= thousandsCurrencyFormat($v['sold_this']) ?> Sold
                                </td>
                                <td><?= $v['month'] ?></td>
                                <td><?= $v['year'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
</script>
<?= $this->endSection() ?>