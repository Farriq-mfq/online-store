<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<main class="inner-page-sec-padding-bottom">
    <div class="container">
        <?php if (count($products)) : ?>
            <div class="shop-toolbar mb--30">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <!-- Product View Mode -->
                        <div class="product-view-mode">
                            <a href="#" class="sorting-btn <?php if ($filter_view == "grid") : ?>active<?php endif ?>" data-target="grid"><i class="fas fa-th"></i></a>
                            <a href="#" class="sorting-btn <?php if ($filter_view == "grid-four") : ?>active<?php endif ?>" data-target="grid-four">
                                <span class="grid-four-icon">
                                    <i class="fas fa-grip-vertical"></i><i class="fas fa-grip-vertical"></i>
                                </span>
                            </a>
                            <a href="#" class="sorting-btn <?php if ($filter_view == "list") : ?>active<?php endif ?>" data-target="list"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-4 col-sm-6  mt--10 mt-sm--0">
                        <span class="toolbar-status">
                            Showing <?= $number ?> to <?= $end ?> of <?= $pager->getDetails("product")['total'] ?> (<?= $pager->getDetails("product")['pageCount'] ?> Pages)
                        </span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6  mt--10 mt-md--0">
                        <div class="sorting-selection">
                            <span>Show:</span>
                            <select class="form-control nice-select sort-select" id="perpage_change">
                                <?php $page_show = [3, 6, 9, 12] ?>
                                <?php foreach ($page_show as $showC) : ?>
                                    <option value="<?= $showC ?>" <?php if ($pager->getDetails("product")["perPage"] == $showC) : ?>selected="selected" <?php endif ?>><?= $showC ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0 ">
                        <div class="sorting-selection">
                            <span>Sort By:</span>
                            <select class="form-control nice-select sort-select mr-0" id="sort_change">
                                <option value="" <?php if ($current_filter == "") : ?>selected="selected" <?php endif ?>>Default Sorting</option>
                                <?php foreach ($filters as $filter) : ?>
                                    <option <?php if ($current_filter == $filter['value']) : ?>selected="selected" <?php endif ?> value="<?= $filter['value'] ?>"><?= $filter['title'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php if (count($products)) : ?>
            <div class="shop-toolbar d-none">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <!-- Product View Mode -->
                        <div class="product-view-mode">
                            <a href="#" class="sorting-btn active" data-target="grid"><i class="fas fa-th"></i></a>
                            <a href="#" class="sorting-btn" data-target="grid-four">
                                <span class="grid-four-icon">
                                    <i class="fas fa-grip-vertical"></i><i class="fas fa-grip-vertical"></i>
                                </span>
                            </a>
                            <a href="#" class="sorting-btn" data-target="list "><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-4 col-sm-6  mt--10 mt-sm--0">
                        <span class="toolbar-status">
                            Showing 1 to 9 of 14 (2 Pages)
                        </span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6  mt--10 mt-md--0">
                        <div class="sorting-selection">
                            <span>Show:</span>
                            <select class="form-control nice-select sort-select">
                                <option value="" selected="selected">3</option>
                                <option value="">9</option>
                                <option value="">5</option>
                                <option value="">10</option>
                                <option value="">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0 ">
                        <div class="sorting-selection">
                            <span>Sort By:</span>
                            <select class="form-control nice-select sort-select mr-0">
                                <option value="" selected="selected">Default Sorting</option>
                                <option value="">Sort
                                    By:Name (A - Z)</option>
                                <option value="">Sort
                                    By:Name (Z - A)</option>
                                <option value="">Sort
                                    By:Price (Low &gt; High)</option>
                                <option value="">Sort
                                    By:Price (High &gt; Low)</option>
                                <option value="">Sort
                                    By:Rating (Highest)</option>
                                <option value="">Sort
                                    By:Rating (Lowest)</option>
                                <option value="">Sort
                                    By:Model (A - Z)</option>
                                <option value="">Sort
                                    By:Model (Z - A)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="shop-product-wrap <?= $filter_view ?> with-pagination row space-db--30 shop-border">
            <?php if (count($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-card <?php if ($filter_view == "list") : ?>card-style-list<?php endif ?>">
                            <div class="product-grid-content">
                                <div class="product-header">
                                    <a href="#" class="author">
                                        <?= $product->brand ?  $product->brand->brand : "No author / brand" ?>
                                        <?= $product->category_id ?>
                                    </a>
                                    <h3><a href="<?= base_url("/shop/" . $product->slug) ?>"><?= $product->title ?></a></h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <?php foreach ($product->product_images as $image) : ?>
                                            <?php if ($image->is_primary) : ?>
                                                <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <div class="hover-contents">
                                            <a href="<?= base_url("/shop/" . $product->slug) ?>" class="hover-image">
                                                <?php foreach ($product->product_images as $image) : ?>
                                                    <?php if ($image->is_primary) : ?>
                                                        <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </a>
                                            <div class="hover-btns">
                                                <?php if (auth_user()) : ?>
                                                    <button class="single-btn" id="__btn__add__to__cart" data-id="<?= $product->product_id ?>"><i class="fas fa-shopping-basket"></i></button>
                                                <?php else : ?>
                                                    <a href="<?= base_url('/auth') ?>" class="single-btn">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </a>
                                                <?php endif ?>
                                                <a href="wishlist.html" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <a href="#" class="single-btn" id="show_detail_product" data-id="<?= $product->product_id ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <?php if (count($product->product_discount)) : ?>
                                            <?php foreach ($product->product_discount as $discount) : ?>
                                                <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                    <span class="price"><?= format_rupiah(get_discount($product->price, $discount->discount_value)) ?></span>
                                                    <del class="price-old"><?= format_rupiah($product->price) ?></del>
                                                    <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                <?php elseif ($discount->discount_type === "VALUE") : ?>
                                                    <span class="price"><?= format_rupiah(get_less_price($product->price, $discount->discount_value)) ?></span>
                                                    <del class="price-old"><?= format_rupiah($product->price) ?></del>
                                                    <span class="price-discount"><?= thousandsCurrencyFormat($discount->discount_value) ?></span>
                                                <?php else : ?>
                                                    <span class="price"><?= format_rupiah($product->price) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <span class="price"><?= format_rupiah($product->price) ?></span>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="product-list-content">
                                <div class="card-image">
                                    <?php foreach ($product->product_images as $image) : ?>
                                        <?php if ($image->is_primary) : ?>
                                            <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </div>
                                <div class="product-card--body">
                                    <div class="product-header">
                                        <a href="#" class="author">
                                            <?= $product->brand ?  $product->brand->brand : "No author / brand" ?>
                                        </a>
                                        <h3><a href="<?= base_url("/shop/" . $product->slug) ?>" tabindex="0"><?= $product->title ?></a></h3>
                                    </div>
                                    <article>
                                        <h2 class="sr-only">Card List Article</h2>
                                        <p><?= $product->short_description ?></p>
                                    </article>
                                    <div class="price-block">
                                        <?php if (count($product->product_discount)) : ?>
                                            <?php foreach ($product->product_discount as $discount) : ?>
                                                <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                    <span class="price"><?= format_rupiah(get_discount($product->price, $discount->discount_value)) ?></span>
                                                    <del class="price-old"><?= format_rupiah($product->price) ?></del>
                                                    <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                <?php elseif ($discount->discount_type === "VALUE") : ?>
                                                    <span class="price"><?= format_rupiah(get_less_price($product->price, $discount->discount_value)) ?></span>
                                                    <del class="price-old"><?= format_rupiah($product->price) ?></del>
                                                    <span class="price-discount"><?= thousandsCurrencyFormat($discount->discount_value) ?></span>
                                                <?php else : ?>
                                                    <span class="price"><?= format_rupiah($product->price) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <span class="price"><?= format_rupiah($product->price) ?></span>
                                        <?php endif ?>
                                    </div>
                                    <div class="rating-block">
                                        <?php if ($product->product_reviews) : ?>
                                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                                <?php if (get_avg($product->product_reviews, "rating") <= $i) : ?>
                                                    <span class="fas fa-star"></span>
                                                <?php else : ?>
                                                    <span class="fas fa-star star_on"></span>
                                                <?php endif ?>
                                            <?php endfor ?>
                                        <?php else : ?>
                                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                                <span class="fas fa-star"></span>
                                            <?php endfor ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="btn-block">
                                        <?php if (auth_user()) : ?>
                                            <button class="btn btn-outlined" id="__btn__add__to__cart" data-id="<?= $product->product_id ?>">Add to
                                                Cart</button>
                                        <?php else : ?>
                                            <a href="<?= base_url('/auth') ?>" class="btn btn-outlined">Add to
                                                Cart</a>
                                        <?php endif ?>
                                        <a href="#" class="card-link"><i class="fas fa-heart"></i> Add To Wishlist</a>
                                        <a href="#" class="card-link"><i class="fas fa-random"></i> Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <div class="col-lg-12 col-sm-12">
                    <div class="text-center">
                        <h5>NO PRODUCT EXIST</h5>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <!-- Pagination Block -->
        <?php if (count($products)) : ?>
            <div class="row pt--30">
                <div class="col-md-12">
                    <?= $pager->links("product", "custom_pg") ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    function removeURLParameter(url, parameter) {
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {

            var prefix = encodeURIComponent(parameter) + '=';
            var pars = urlparts[1].split(/[&;]/g);

            for (var i = pars.length; i-- > 0;) {
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            url = urlparts[0] + '?' + pars.join('&');
            return url;
        } else {
            return url;
        }
    }
    $("#sort_change").change(function(e) {
        e.preventDefault()
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.set("sort", $(this).val());
        window.location.search = searchParams.toString();
    })
    $("#perpage_change").change(function(e) {
        e.preventDefault()
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.set("perpage", $(this).val());
        window.location.search = searchParams.toString();
    })

    $(".sorting-btn").on("click", function(e) {
        e.preventDefault();
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.set("view", $(this).data('target'));
        let newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + searchParams.toString();
        window.history.pushState({
            path: newurl
        }, '', newurl);
    })
</script>
<?= $this->endSection() ?>