<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<main class="inner-page-sec-padding-bottom">
    <div class="container">
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
        <div class="shop-product-wrap <?= $filter_view ?> with-pagination row space-db--30 shop-border">
            <?php foreach ($products as $product) : ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="product-card <?php if ($filter_view == "list") : ?>card-style-list<?php endif ?>">
                        <div class="product-grid-content">
                            <div class="product-header">
                                <a href="#" class="author">
                                    <?= $product->brand ?  $product->brand->brand : "No author / brand" ?>
                                </a>
                                <h3><a href="product-details.html"><?= $product->title ?></a></h3>
                            </div>
                            <div class="product-card--body">
                                <div class="card-image">
                                    <?php foreach ($product->product_images as $image) : ?>
                                        <?php if ($image->is_primary) : ?>
                                            <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                        <?php endif ?>
                                    <?php endforeach ?>
                                    <div class="hover-contents">
                                        <a href="product-details.html" class="hover-image">
                                            <?php foreach ($product->product_images as $image) : ?>
                                                <?php if ($image->is_primary) : ?>
                                                    <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </a>
                                        <div class="hover-btns">
                                            <a href="cart.html" class="single-btn">
                                                <i class="fas fa-shopping-basket"></i>
                                            </a>
                                            <a href="wishlist.html" class="single-btn">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                            <a href="compare.html" class="single-btn">
                                                <i class="fas fa-random"></i>
                                            </a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quickModal" class="single-btn">
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
                                    <h3><a href="product-details.html" tabindex="0"><?= $product->title ?></a></h3>
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
                                    <a href="#" class="btn btn-outlined">Add To Cart</a>
                                    <a href="#" class="card-link"><i class="fas fa-heart"></i> Add To Wishlist</a>
                                    <a href="#" class="card-link"><i class="fas fa-random"></i> Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- Pagination Block -->
        <div class="row pt--30">
            <div class="col-md-12">
                <?= $pager->links("product", "custom_pg") ?>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade modal-quick-view" id="quickModal" tabindex="-1" role="dialog" aria-labelledby="quickModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="product-details-modal">
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- Product Details Slider Big Image-->
                                <div class="product-details-slider sb-slick-slider arrow-type-two" data-slick-setting='{
                                "slidesToShow": 1,
                                "arrows": false,
                                "fade": true,
                                "draggable": false,
                                "swipe": false,
                                "asNavFor": ".product-slider-nav"
                                }'>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-1.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-2.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-3.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-4.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-5.jpg" alt="">
                                    </div>
                                </div>
                                <!-- Product Details Slider Nav -->
                                <div class="mt--30 product-slider-nav sb-slick-slider arrow-type-two" data-slick-setting='{
        "infinite":true,
          "autoplay": true,
          "autoplaySpeed": 8000,
          "slidesToShow": 4,
          "arrows": true,
          "prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},
          "nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},
          "asNavFor": ".product-details-slider",
          "focusOnSelect": true
          }'>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-1.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-2.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-3.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-4.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="image/products/product-details-5.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 mt--30 mt-lg--30">
                                <div class="product-details-info pl-lg--30 ">
                                    <p class="tag-block">Tags: <a href="#">Movado</a>, <a href="#">Omega</a></p>
                                    <h3 class="product-title">Beats EP Wired On-Ear Headphone-Black</h3>
                                    <ul class="list-unstyled">
                                        <li>Ex Tax: <span class="list-value"> £60.24</span></li>
                                        <li>Brands: <a href="#" class="list-value font-weight-bold"> Canon</a></li>
                                        <li>Product Code: <span class="list-value"> model1</span></li>
                                        <li>Reward Points: <span class="list-value"> 200</span></li>
                                        <li>Availability: <span class="list-value"> In Stock</span></li>
                                    </ul>
                                    <div class="price-block">
                                        <span class="price-new">£73.79</span>
                                        <del class="price-old">£91.86</del>
                                    </div>
                                    <div class="rating-widget">
                                        <div class="rating-block">
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star "></span>
                                        </div>
                                        <div class="review-widget">
                                            <a href="#">(1 Reviews)</a> <span>|</span>
                                            <a href="#">Write a review</a>
                                        </div>
                                    </div>
                                    <article class="product-details-article">
                                        <h4 class="sr-only">Product Summery</h4>
                                        <p>Long printed dress with thin adjustable straps. V-neckline and wiring under
                                            the Dust with ruffles
                                            at the bottom
                                            of the
                                            dress.</p>
                                    </article>
                                    <div class="add-to-cart-row">
                                        <div class="count-input-block">
                                            <span class="widget-label">Qty</span>
                                            <input type="number" class="form-control text-center" value="1">
                                        </div>
                                        <div class="add-cart-btn">
                                            <a href="#" class="btn btn-outlined--primary"><span class="plus-icon">+</span>Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="compare-wishlist-row">
                                        <a href="#" class="add-link"><i class="fas fa-heart"></i>Add to Wish List</a>
                                        <a href="#" class="add-link"><i class="fas fa-random"></i>Add to Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="widget-social-share">
                            <span class="widget-label">Share:</span>
                            <div class="modal-social-share">
                                <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    resetUrl();
    function resetUrl(){
        var searchParams = new URLSearchParams(window.location.search);
        console.log(searchParams);
        
        if(searchParams.get("view") == ""){
            console.log("ok")
        }
    }
</script>
<?= $this->endSection() ?>