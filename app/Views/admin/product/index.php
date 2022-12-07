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
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Discount</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($products as $product): ?>
                  <tr>
                    <td>
                      <p>
                        <div class="d-flex align-items-center">
                          <b><?= $product->title ?></b>
                          <?php if($product->new_label): ?>
                            <div class="badge badge-info ml-2">New</div>
                          <?php endif ?>
                        </div>
                      </p>
                      <?php if($product->featured): ?>
                      <p class="text-warning text-sm lead">
                        <i class="fas fa-star"></i>
                        Featured
                      </p>
                      <?php endif ?>
                      <p>
                      <?php if($product->status): ?>
                      <p class="text-succes text-sm lead">
                        <i class="text-success fas fa-check"></i> 
                        Active
                      </p>
                      <?php else: ?>
                        <p class="text-danger text-sm lead">
                          <i class="fas fa-times"></i>
                          Inactive
                        </p>
                      <?php endif ?>
                    </td>
                    <td><?= $product->price ?></td>
                    <td><?= $product->weight ?></td>
                    <td><?= $product->brand == NULL ? "No Brand":$product->brand->brand ?></td>
                    <td><?= $product->brand == NULL ? "No Category":$product->category->category ?></td>
                    <td><?= $product->discount == NULL ? "No discount":$product->discount ?></td>
                    <td>
                      <a href="<?= admin_url("/product/".esc($product->product_id)."/edit") ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                      <button class=" btn btn-danger btn-sm" confirm  data-slug="<?= $product->slug ?>" data-action="<?= admin_url("/product/".esc($product->product_id)) ?>"><i class="fas fa-trash"></i></button>
                      <a href="<?= admin_url("/product/".esc($product->product_id)."/edit") ?>" class="btn btn bg-gradient-info btn-sm"><i class="fas fa-arrow-right"></i></a>
                      <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm">Action</button>
                      <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                          <form action="<?= admin_url("/product/".esc($product->product_id)."/new_label") ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="dropdown-item">New Label / Remove New Label</button>
                          </form>
                          <form action="<?= admin_url("/product/".esc($product->product_id)."/featured") ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="dropdown-item">Featured / UnFeatured</button>
                          </form>
                          <form action="<?= admin_url("/product/".esc($product->product_id)."/status") ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="dropdown-item">Active / Inactive</button>
                          </form>
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