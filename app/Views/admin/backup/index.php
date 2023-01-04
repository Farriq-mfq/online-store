<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Backup Database</h4>
            </div>
            <div class="card-body">
                <p>Just Click Backup to backup database</p>
                <p>DBname : <?= $dbname ?></p>
                <p>Path : <?= $path ?></p>
                <p>Filename : <?= $filename ?></p>
                <form action="<?= admin_url("/backup") ?>" method="POST">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="replace_backup" id="replaceCheck">
                        <label class="form-check-label" for="replaceCheck">
                            Replace Backup
                        </label>
                    </div>
                    <?= csrf_field() ?>
                    <button type="submit" class="btn bg-purple"><i class="fa fa-database"></i>&nbsp;Backup</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>