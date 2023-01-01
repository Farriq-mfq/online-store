<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<form action="<?= admin_url("mail") ?>" method="POST">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Setting SMTP</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label required>PROTOCOL</label>
                        <input type="text" class="form-control <?= show_class_error("protocol") ?>" name="protocol" value="<?= isset($mail->protocol) ? $mail->protocol : set_value("protocol")   ?>">
                        <?= show_error('protocol') ?>
                    </div>
                    <div class="form-group">
                        <label required>SMTP HOST</label>
                        <input type="text" class="form-control <?= show_class_error("host") ?>" name="host" value="<?= isset($mail->host) ? $mail->host : set_value("host")  ?>">
                        <?= show_error('host') ?>
                    </div>
                    <div class="form-group">
                        <label required>SMTP USER</label>
                        <input type="text" class="form-control <?= show_class_error("user") ?>" name="user" value="<?= isset($mail->user) ? $mail->user : set_value("user")  ?>">
                        <?= show_error('user') ?>
                    </div>
                    <div class="form-group">
                        <label required>SMTP PASSWORD</label>
                        <input type="text" class="form-control <?= show_class_error("password") ?>" name="password" value="<?= isset($mail->password) ? $mail->password : set_value("password")  ?>">
                        <?= show_error('password') ?>
                    </div>
                    <div class="form-group">
                        <label required>SMTP PORT</label>
                        <input type="number" class="form-control <?= show_class_error("port") ?>" name="port" value="<?= isset($mail->port) ? $mail->port : set_value("port")  ?>">
                        <?= show_error('port') ?>
                    </div>
                    <div class="form-group">
                        <label required>SMTP CRYPTO (SSL/TLS)</label>
                        <input type="text" class="form-control <?= show_class_error("crypto") ?>" name="crypto" value="<?= isset($mail->crypto) ? $mail->crypto : set_value("crypto")  ?>">
                        <?= show_error('crypto') ?>
                    </div>
                    <div class="form-group">
                        <label required>MAIL TYPE</label>
                        <select class="form-control <?= show_class_error("type") ?>" name="type">
                            <option value="">Select Mail Type</option>
                            <?php if (isset($mail->type)) : ?>
                                <option value="text" <?php if ($mail->type == 'text') : ?>selected<?php endif ?>>Text</option>
                                <option value="html" <?php if ($mail->type == 'html') : ?>selected<?php endif ?>>HTML</option>
                            <?php else : ?>
                                <option value="text">Text</option>
                                <option value="html">HTML</option>
                            <?php endif ?>
                        </select>
                        <?= show_error('type') ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>USER AGENT</label>
                        <input type="text" class="form-control" name="useragent" value="<?= isset($mail->useragent) ? $mail->useragent : set_value("useragent")  ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<?= $this->endSection() ?>