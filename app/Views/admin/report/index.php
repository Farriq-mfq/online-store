<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form action="<?= admin_url('/report/generate/sales/pdf?year='.$selected_year) ?>" method="POST">
                    <?= csrf_field() ?>
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-print"></i>
                        Download PDF / Print
                    </button>

                </form>
                <div class="form-group mt-2">
                    <label for=""> Filter Year</label>
                    <select name="" class="form-control" id="__CHANGE__YEAR">
                        <option value="">Select Year</option>
                        <?php foreach ($filters  as $filter) : ?>
                            <option value="<?= $filter->year ?>" <?php if ($selected_year == $filter->year) : ?>selected<?php endif ?>><?= $filter->year ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <h4 class="mt-4">Information of increase or decrease</h4>
                <p class="ml-auto d-flex flex-column text-left mt-3">
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
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Income Per Month</th>
                            <th>Years</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($years as $data) : ?>
                            <tr>
                                <td>
                                    <?= $data->month ?>
                                </td>
                                <td>
                                    <?= format_rupiah($data->total_permonth) ?>
                                </td>
                                <td>
                                    <?= $data->year ?>
                                </td>
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
    $("#__CHANGE__YEAR").change(function(e) {
        e.preventDefault()
        window.location.href = "<?= current_url() ?>?year=" + $(this).val();
    })
</script>
<?= $this->endSection() ?>