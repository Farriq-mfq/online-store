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
                            <th>Riviews</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <?= $product->title ?> (<?= count($product->product_reviews) ?>)
                                </td>
                                <td>
                                    <?php if (count($product->product_reviews)) : ?>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <p>Total Reviews </p>
                                                <p>
                                                    <?php for ($i = 0; $i < get_avg($product->product_reviews, "rating"); $i++) : ?>
                                                        <i class="fas fa-star text-warning"></i>
                                                    <?php endfor ?>
                                                    <span style="font-size: 25px">(<?= get_avg($product->product_reviews, "rating") ?>)</span>
                                                </p>
                                            </li>
                                            <?php foreach ($product->product_reviews as $reviews) : ?>
                                                <li class="list-group-item">
                                                    <?php foreach ($userReviews as $usrr) : ?>
                                                        <?php if ($usrr->review_id == $reviews->review_id) : ?>
                                                            <p><?= $reviews->review ?> - <?= $usrr->user->name ?></p>
                                                            <div class="d-inline">
                                                                <?php for ($i = 0; $i < $reviews->rating; $i++) : ?>
                                                                    <i class="fas fa-star text-warning"></i>
                                                                <?php endfor ?>
                                                                <span>(<?= $reviews->rating ?>)</span>
                                                            </div>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php else : ?>
                                        No Reviews
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