<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <?= $product->title ?> (<?= count($product->product_comments) ?>)
                                </td>
                                <td>
                                    <?php if (count($product->product_comments)) : ?>
                                        <ul class="list-group">
                                            <?php foreach ($product->product_comments as $comments) : ?>
                                                <?php foreach ($userComments as $cmt) : ?>
                                                    <?php if ($cmt->comment_id == $comments->comment_id) : ?>
                                                        <li class="list-group-item">
                                                            <p>
                                                                <?= $comments->comment ?>
                                                                -(<?= $cmt->user->name ?>)
                                                            </p>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php else : ?>
                                        No Comment Yet
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script <?= csp_script_nonce() ?>>

</script>
<?= $this->endSection() ?>