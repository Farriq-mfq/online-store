<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form action="<?= admin_url('/report/generate/visitor/pdf?year=' . $selected_year . '&month=' . $selected_month . '') ?>" method="POST">
                    <?= csrf_field() ?>
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-print"></i>
                        Download PDF / Print
                    </button>
                </form>
                <form action="<?= admin_url("/report/visitor") ?>" method="GET" class="mt-2">
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
                <h4 class="mt-4">Information of increase or decrease</h4>
                <p class="ml-auto d-flex flex-column text-left mt-3">
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
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Total Visitor</th>
                            <th>Month</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getVisitorByMonth as $v) : ?>
                            <tr>
                                <td><?= $v->day ?></td>
                                <td><?= thousandsCurrencyFormat($v->total) ?></td>
                                <td><?= $v->month ?></td>
                                <td><?= $v->year ?></td>
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