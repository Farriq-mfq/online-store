<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Title Product</th>
                      <th>Price</th>
                      <th>Weight</th>
                      <th>Discount</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($products as $product): ?>
                  <tr>
                    <td><?= $product->title ?></td>
                    <td><?= $product->price ?></td>
                    <td><?= $product->weight ?></td>
                    <td><?= $product->discount == NULL ? "No discount":$product->discount ?></td>
                    <td>
                      <a href="<?= admin_url("/product/".esc($product->product_id)."/edit") ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                      <button class=" btn btn-danger btn-sm" confirm  data-slug="<?= $product->slug ?>" data-action="<?= admin_url("/product/".esc($product->product_id)) ?>"><i class="fas fa-trash"></i></button>
                      <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm">Action</button>
                      <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                      </div>
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
<!-- <?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?> -->