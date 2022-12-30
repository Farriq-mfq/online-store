<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form action="<?= admin_url('/report/generate/sales/pdf?year') ?>" method="POST">
                    <?= csrf_field() ?>
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-print"></i>
                        Download PDF / Print
                    </button>

                </form>
                <div class="form-group mt-2">
                    <label for=""> Filter Year</label>
                    <select name="" class="form-control" id="__CHANGE__YEAR">
                        <option value="">Select Day</option>
                    </select>
                </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getVisitorByMonth as $v) : ?>
                            <tr>
                                <td><?= $v->day ?></td>
                                <td><?= thousandsCurrencyFormat($v->total) ?></td>
                                <td><?= $v->month ?></td>
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