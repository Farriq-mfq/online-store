<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Manage Website</h3>
                </div>
            </div>

            <form action="<?= admin_url('/website/change') ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label required>Title Separator max 50 character</label>
                        <input type="text" class="form-control <?= show_class_error('title_separator') ?>" name="title_separator" value="<?= $website ? $website->title_separator : "" ?>">
                        <?= show_error('title_separator') ?>
                    </div>
                    <div class="form-group">
                        <label required>Logo</label>
                        <input type="file" class="form-control <?= show_class_error('logo') ?>" name="logo">
                        <img src="<?= $website ? $website->logo : "#" ?>" alt="Preview" class="img-thumbnail mt-2">
                        <?= show_error('logo') ?>
                    </div>
                    <div class="form-group">
                        <label required>Favicon</label>
                        <input type="file" class="form-control  <?= show_class_error('favicon') ?>" name="favicon">
                        <?= show_error('favicon') ?>
                        <img src="<?= $website ? $website->favicon : "#" ?>" alt="Preview" class="img-thumbnail mt-2">

                    </div>
                    <div class="form-group">
                        <label required>Support Content</label>

                        <textarea id="support_content" name="support_content" class="<?= show_class_error('support_content') ?>"><?= $website ? $website->support_content : "" ?></textarea>
                        <?= show_error("support_content") ?>
                    </div>
                    <div class="form-group">
                        <label required>Footer Content</label>
                        <textarea id="footer_content" name="footer_content" class="<?= show_class_error('footer_content') ?>"><?= $website ? $website->footer_content : "" ?></textarea>
                        <?= show_error("footer_content") ?>
                    </div>
                    <div class="form-group">
                        <label required>Information Content</label>
                        <textarea id="information_content" name="information_content" class="<?= show_class_error('information_content') ?>"><?= $website ? $website->information_content : "" ?></textarea>
                        <?= show_error("information_content") ?>
                    </div>
                    <div class="form-group">
                        <label required>Extrans Content</label>
                        <textarea id="extras_content" name="extras_content" class="<?= show_class_error('extras_content') ?>"><?= $website ? $website->extras_content : "" ?></textarea>
                        <?= show_error("extras_content") ?>
                    </div>
                    <div class="form-group">
                        <label required>Company Address</label>
                        <textarea class="form-control" name="company_address" class="<?= show_class_error('company_address') ?>"><?= $website ? $website->company_address : "" ?></textarea>
                        <?= show_error("company_address") ?>
                    </div>
                    <div class="form-group">
                        <label required>Company Phone</label>
                        <input type="number" name="company_phone" class="form-control <?= show_class_error('company_phone') ?>" value="<?= $website ? $website->company_phone : "" ?>">
                        <?= show_error("company_phone") ?>
                    </div>
                    <div class="form-group">
                        <label required>Company Email</label>
                        <input type="text" class="form-control <?= show_class_error('company_email') ?>" name="company_email" value="<?= $website ? $website->company_email : "" ?>">
                        <?= show_error("company_email") ?>
                    </div>
                    <div class="form-group">
                        <label required>Shipping Origin</label>
                        <select name="shipping_origin" id="shipping_origin" class="select2 form-control <?= show_class_error('shipping_origin') ?>">
                            <option value="">Select City</option>
                            <?php foreach ($city as $c) : ?>
                                <option <?php if ($website) : ?><?php if ($website->shipping_origin == $c->city_id) : ?>selected<?php endif ?><?php endif ?> value="<?= $c->city_id ?>"> <?= $c->type ?> <?= $c->city_name ?> </option>
                            <?php endforeach ?>
                        </select>
                        <?= show_error("shipping_origin") ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>
    $("#support_content").summernote();
    $("#footer_content").summernote();
    $("#information_content").summernote();
    $("#extras_content").summernote();
</script>
<?= $this->endSection() ?>