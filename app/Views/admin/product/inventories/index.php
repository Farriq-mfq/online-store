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
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <?= $product->title ?>
                                </td>
                                <td>
                                    <input id="PRODUCT_STOCK_CHANGE" type="number" class="form-control" min="0" data-id="<?= $product->product_id ?>" value="<?= $product->stock  ?>">
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
    $(document).on("change", "#PRODUCT_STOCK_CHANGE", function(e) {
        e.preventDefault();
        $.post({
            url: "<?= admin_url("/product/inventories/stockChange") ?>",
            data: {
                id: $(this).data("id"),
                stock: $(this).val()
            },
            success: (data) => {
                if (data.success) {
                    swal.fire({
                        title: 'Success',
                        icon:"success",
                        text: "Update Stock Success",
                    })
                }
            }
        })
    })
</script>
<?= $this->endSection() ?>