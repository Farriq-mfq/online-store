<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<main class="inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row  mb--60">
            <div class="col-lg-5 mb--30">
                <!-- Product Details Slider Big Image-->
                <div class="product-details-slider sb-slick-slider arrow-type-two" data-slick-setting='{
      "slidesToShow": 1,
      "arrows": false,
      "fade": true,
      "draggable": false,
      "swipe": false,
      "asNavFor": ".product-slider-nav"
      }'>
                    <?php foreach ($product->product_images as $image) : ?>
                        <div class="single-slide">
                            <img src="<?= $image->image ?>" alt="">
                        </div>
                    <?php endforeach ?>
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
                    <?php foreach ($product->product_images as $image) : ?>
                        <div class="single-slide">
                            <img src="<?= $image->image ?>" alt="">
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="product-details-info pl-lg--30 ">
                    <p class="tag-block">Tags:
                        <?php if (count($tags)) : ?>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="#"><?= $tag->tag ?></a>,
                            <?php endforeach ?>
                        <?php else : ?>
                            -
                        <?php endif ?>
                    </p>
                    <h3 class="product-title"><?= $product->title ?></h3>
                    <ul class="list-unstyled">
                        <li>Brands: <a href="#" class="list-value font-weight-bold"> <?= $product->brand != null ? $product->brand->brand : "No Brand / Author" ?></a></li>
                        <li>Availability: <span class="list-value <?php if (!$product->stock > 0) : ?>text-danger<?php endif ?>"> <?= $product->stock > 0 ? "In Stock" : "Out Of Stock" ?></span></li>
                    </ul>
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
                    <div class="rating-widget">
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
                        <div class="review-widget">
                            <a href="#">(<?= count($product->product_reviews) ?> Reviews)</a> <span>|</span>
                            <a href="#">Write a review</a>
                        </div>
                    </div>
                    <article class="product-details-article">
                        <h4 class="sr-only">Product Summery</h4>
                        <p><?= $product->short_description ?>.</p>
                    </article>
                    <div class="add-to-cart-row">
                        <div class="count-input-block">
                            <span class="widget-label">Qty</span>
                            <input type="number" class="form-control text-center" value="1" min="0" id="__qty__to__add__cart">
                        </div>
                        <div class="add-cart-btn">
                            <?php if (auth_user()) : ?>
                                <button class="btn btn-outlined--primary" id="__btn__add__to__cart" data-id="<?= $product->product_id ?>"><span class="plus-icon">+</span>Add to
                                    Cart</button>
                            <?php else : ?>
                                <a href="<?= base_url('/auth') ?>" class="btn btn-outlined--primary"><span class="plus-icon">+</span>Add to
                                    Cart</a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="compare-wishlist-row">
                        <a href="#" class="add-link"><i class="fas fa-heart"></i>Add to Wish List</a>
                        <a href="#" class="add-link"><i class="fas fa-random"></i>Add to Compare</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sb-custom-tab review-tab section-padding">
            <ul class="nav nav-tabs nav-style-2" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1" data-bs-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">
                        DESCRIPTION
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="true">
                        REVIEWS (<?= count($product->product_reviews) ?>)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab3" data-bs-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="true">
                        DETAILS
                    </a>
                </li>
            </ul>
            <div class="tab-content space-db--20" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab1">
                    <article class="review-article">
                        <h1 class="sr-only">Tab Article</h1>
                        <p><?= $product->description ?></p>
                    </article>
                </div>
                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab2">
                    <div class="review-wrapper">
                        <h2 class="title-lg mb--20"><?= count($product->product_reviews) ?> REVIEW FOR <?= $product->title ?></h2>
                        <?php if (count($reviews)) : ?>
                            <?php foreach ($reviews as $review) : ?>
                                <div class="review-comment mb--20">
                                    <div class="avatar">
                                        <img src="image/icon/author-logo.png" alt="">
                                    </div>
                                    <div class="text">
                                        <div class="rating-block mb--15">
                                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                                <?php if ($review->rating <= $i) : ?>
                                                    <span class="ion-android-star-outline"></span>
                                                <?php else : ?>
                                                    <span class="ion-android-star-outline star_on"></span>
                                                <?php endif ?>
                                            <?php endfor ?>
                                        </div>
                                        <h6 class="author"><?= $review->name ?> – <span class="font-weight-400"><?= date("d/m/Y H-i-s", strtotime($review->created_at)) ?></span>
                                        </h6>
                                        <p><?= $review->review ?></p>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <div class="review-comment mb--20">
                                <p>No Reviews Here</p>
                            </div>
                        <?php endif ?>
                        <!-- end -->
                        <h2 class="title-lg mb--20 pt--15">ADD A REVIEW</h2>
                        <div class="rating-row pt-2">
                            <p class="d-block">Your Rating</p>
                            <form action="<?= base_url("/shop/" . $product->product_id . "/review") ?>" class="mt--15" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <span class="rating-widget-block <?= show_class_error("star") ?>">
                                                <input type="radio" name="star" id="star1" value="5">
                                                <label for="star1"></label>
                                                <input type="radio" name="star" id="star2" value="4">
                                                <label for="star2"></label>
                                                <input type="radio" name="star" id="star3" value="3">
                                                <label for="star3"></label>
                                                <input type="radio" name="star" id="star4" value="2">
                                                <label for="star4"></label>
                                                <input type="radio" name="star" id="star5" value="1">
                                                <label for="star5"></label>
                                            </span>
                                            <?= show_error('star') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Review</label>
                                            <textarea name="review" id="review" cols="30" rows="10" class="form-control <?= show_class_error('review') ?>"></textarea>
                                            <?= show_error('review') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="submit-btn">
                                            <button type="submit" class="btn btn-black">Post Review</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab3">
                    <?= html_entity_decode($product->content) ?>
                </div>
            </div>
        </div>
    </div>
    <!--=================================
RELATED PRODUCTS BOOKS
===================================== -->
    <section class="">
        <div class="container">
            <div class="section-title section-title--bordered">
                <h2>RELATED PRODUCTS</h2>
            </div>
            <div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
        "autoplay": true,
        "autoplaySpeed": 8000,
        "slidesToShow": 4,
        "dots":true
    }' data-slick-responsive='[
        {"breakpoint":1200, "settings": {"slidesToShow": 4} },
        {"breakpoint":992, "settings": {"slidesToShow": 3} },
        {"breakpoint":768, "settings": {"slidesToShow": 2} },
        {"breakpoint":480, "settings": {"slidesToShow": 1} }
    ]'>
                <?php if (count($relateds)) : ?>
                    <?php foreach ($relateds as $related) : ?>
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="#" class="author">
                                        <?= $related->brand ?  $related->brand->brand : "No author / brand" ?>
                                    </a>
                                    <h3><a href="<?= base_url('/shop' . '/' . $related->slug) ?>"><?= $related->title ?></a></h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <?php foreach ($related->product_images as $image) : ?>
                                            <?php if ($image->is_primary) : ?>
                                                <img src="<?= $image->image ?>" alt="Product Image">
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <div class="hover-contents">
                                            <a href="<?= base_url('/shop' . '/' . $related->slug) ?>" class="hover-image">
                                                <?php foreach ($related->product_images as $image) : ?>
                                                    <?php if ($image->is_primary) : ?>
                                                        <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </a>
                                            <div class="hover-btns">
                                                <?php if (auth_user()) : ?>
                                                    <button class="single-btn" id="__btn__add__to__cart" data-id="<?= $related->product_id ?>"><i class="fas fa-shopping-basket"></i></button>
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
                                                <a href="#" class="single-btn" id="show_detail_product" data-id="<?= $related->product_id ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <?php if (count($related->product_discount)) : ?>
                                            <?php foreach ($related->product_discount as $discount) : ?>
                                                <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                    <span class="price"><?= format_rupiah(get_discount($related->price, $discount->discount_value)) ?></span>
                                                    <del class="price-old"><?= format_rupiah($related->price) ?></del>
                                                    <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                <?php elseif ($discount->discount_type === "VALUE") : ?>
                                                    <span class="price"><?= format_rupiah(get_less_price($related->price, $discount->discount_value)) ?></span>
                                                    <del class="price-old"><?= format_rupiah($related->price) ?></del>
                                                    <span class="price-discount"><?= thousandsCurrencyFormat($discount->discount_value) ?></span>
                                                <?php else : ?>
                                                    <span class="price"><?= format_rupiah($related->price) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <span class="price"><?= format_rupiah($related->price) ?></span>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else : ?>
                    <div class="single-slide">
                        <div class="product-card">
                            <div class="product-header">
                                <a href="#" class="author">
                                    NO PRODUCT RELATED
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?>