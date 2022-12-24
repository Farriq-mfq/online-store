<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<section class="hero-area hero-slider-2">
    <div class="container">
        <div class="row align-items-lg-center">
            <div class="col-lg-8">
                <div class="sb-slick-slider" data-slick-setting='{
                                                                "autoplay": true,
                                                                "autoplaySpeed": 8000,
                                                                "slidesToShow": 1,
                                                                "dots":true
                                                                }'>
                    <?php foreach ($sliders as $slider) : ?>
                        <div class="single-slide bg-image" data-bg="<?= $slider->image ?>">
                            <div class="home-content pl--30">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <span class="title-mid" style="color: <?= $slider->subtitle_color ?>;"><?= $slider->subtitle ?></span>
                                        <h2 class="h2-v2"><?= $slider->title ?>.</h2>
                                        <p>
                                            <?= $slider->short_description ?>
                                        </p>
                                        <a href="<?= $slider->link ?>" class="btn btn-outlined--primary">
                                            <?= $slider->link_label ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-4 mt--30 mt-lg--0">
                <div class="sb-slick-slider hero-products-group-slider product-border-reset" data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow": 1,
                                            "rows":2
                                        }' data-slick-responsive='[
                                            {"breakpoint":992, "settings": {"slidesToShow": 2,"rows":2} },
                                            {"breakpoint":768, "settings": {"slidesToShow": 1} },
                                         {"breakpoint":490, "settings": {"slidesToShow": 1} }
                                    ]'>
                    <?php if (count($featureds)) : ?>
                        <?php foreach ($featureds as $featured) : ?>
                            <div class="single-slide">
                                <div class="product-card card-style-list">
                                    <div class="card-image">
                                        <?php foreach ($featured->product_images as $image) : ?>
                                            <?php if ($image->is_primary) : ?>
                                                <img src="<?= $image->image ?>" alt="Product Image">
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="product-card--body">
                                        <div class="product-header">
                                            <a href="#" class="author">
                                                <?= $featured->brand ?  $featured->brand->brand : "No author / brand" ?>
                                            </a>
                                            <h3><a href="product-details.html"><?= $featured->title ?></a></h3>
                                        </div>
                                        <div class="price-block">
                                            <?php if (count($featured->product_discount)) : ?>
                                                <?php foreach ($featured->product_discount as $discount) : ?>
                                                    <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                        <span class="price"><?= format_rupiah(get_discount($featured->price, $discount->discount_value)) ?></span>
                                                        <del class="price-old"><?= format_rupiah($featured->price) ?></del>
                                                        <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                    <?php elseif ($discount->discount_type === "PERCENTAGE") : ?>
                                                        <span class="price"><?= format_rupiah(get_less_price($featured->price, $discount->discount_value)) ?></span>
                                                        <del class="price-old"><?= format_rupiah($featured->price) ?></del>
                                                        <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                    <?php else : ?>
                                                        <span class="price"><?= format_rupiah($featured->price) ?></span>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            <?php else : ?>
                                                <span class="price"><?= format_rupiah($featured->price) ?></span>
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
                                        NO PRODUCT FEATURED
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
        Home Features Section
        ===================================== -->
<section class="mb--30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-6 mt--30">
                <div class="feature-box h-100">
                    <div class="icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="text">
                        <h5>Free Shipping Item</h5>
                        <p> Orders over $500</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt--30">
                <div class="feature-box h-100">
                    <div class="icon">
                        <i class="fas fa-redo-alt"></i>
                    </div>
                    <div class="text">
                        <h5>Money Back Guarantee</h5>
                        <p>100% money back</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt--30">
                <div class="feature-box h-100">
                    <div class="icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div class="text">
                        <h5>Cash On Delivery</h5>
                        <p>Lorem ipsum dolor amet</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt--30">
                <div class="feature-box h-100">
                    <div class="icon">
                        <i class="fas fa-life-ring"></i>
                    </div>
                    <div class="text">
                        <h5>Help & Support</h5>
                        <p>Call us : + 0123.4567.89</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
        Promotion Section One
        ===================================== -->
<section class="section-margin">
    <h2 class="sr-only">Promotion Section</h2>
    <div class="container">
        <div class="row space-db--30">
            <?php foreach ($banner_bottom_slider as $bbs) : ?>
                <div class="col-lg-6 mb--30">
                    <a href="<?= $bbs->link ?>" class="promo-image promo-overlay">
                        <img src="<?= $bbs->image ?>" alt="BANNER">
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<!--=================================
        Home Slider Tab
        ===================================== -->
<section class="section-padding">
    <h2 class="sr-only">Home Tab Slider Section</h2>
    <div class="container">
        <div class="sb-custom-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="shop-tab" data-bs-toggle="tab" href="#shop" role="tab" aria-controls="shop" aria-selected="true">
                        Featured Products
                    </a>
                    <span class="arrow-icon"></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="men-tab" data-bs-toggle="tab" href="#men" role="tab" aria-controls="men" aria-selected="true">
                        New Arrivals
                    </a>
                    <span class="arrow-icon"></span>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active" id="shop" role="tabpanel" aria-labelledby="shop-tab">
                    <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider" data-slick-setting='{
                            "autoplay": true,
                            "autoplaySpeed": 8000,
                            "slidesToShow": 5,
                            "rows":2,
                            "dots":true
                        }' data-slick-responsive='[
                            {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                            {"breakpoint":480, "settings": {"slidesToShow": 1} },
                            {"breakpoint":320, "settings": {"slidesToShow": 1} }
                        ]'>
                        <?php if (count($featureds)) : ?>
                            <?php foreach ($featureds as $featured) : ?>
                                <div class="single-slide">
                                    <div class="product-card">
                                        <div class="product-header">
                                            <a href="#" class="author">
                                                <?= $featured->brand ?  $featured->brand->brand : "No author / brand" ?>
                                            </a>
                                            <h3><a href="product-details.html"><?= $featured->title ?></a></h3>
                                        </div>
                                        <div class="product-card--body">
                                            <div class="card-image">
                                                <?php foreach ($featured->product_images as $image) : ?>
                                                    <?php if ($image->is_primary) : ?>
                                                        <img src="<?= $image->image ?>" alt="Product Image">
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                                <div class="hover-contents">
                                                    <a href="product-details.html" class="hover-image">
                                                        <?php foreach ($featured->product_images as $image) : ?>
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
                                                <?php if (count($featured->product_discount)) : ?>
                                                    <?php foreach ($featured->product_discount as $discount) : ?>
                                                        <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                            <span class="price"><?= format_rupiah(get_discount($featured->price, $discount->discount_value)) ?></span>
                                                            <del class="price-old"><?= format_rupiah($featured->price) ?></del>
                                                            <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                        <?php elseif ($discount->discount_type === "PERCENTAGE") : ?>
                                                            <span class="price"><?= format_rupiah(get_less_price($featured->price, $discount->discount_value)) ?></span>
                                                            <del class="price-old"><?= format_rupiah($featured->price) ?></del>
                                                            <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                        <?php else : ?>
                                                            <span class="price"><?= format_rupiah($featured->price) ?></span>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <span class="price"><?= format_rupiah($featured->price) ?></span>
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
                                            NO PRODUCT FEATURED
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
                <div class="tab-pane" id="men" role="tabpanel" aria-labelledby="shop-tab">
                    <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider" data-slick-setting='{
                            "autoplay": true,
                            "autoplaySpeed": 8000,
                            "slidesToShow": 5,
                            "rows":2,
                            "dots":true
                        }' data-slick-responsive='[
                            {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                            {"breakpoint":480, "settings": {"slidesToShow": 1} },
                            {"breakpoint":320, "settings": {"slidesToShow": 1} }
                        ]'>
                        <?php if (count($news)) : ?>
                            <?php foreach ($news as $new) : ?>
                                <div class="single-slide">
                                    <div class="product-card">
                                        <div class="product-header">
                                            <a href="#" class="author">
                                                <?= $new->brand ?  $new->brand->brand : "No author / brand" ?>
                                            </a>
                                            <h3><a href="product-details.html"><?= $new->title ?></a></h3>
                                        </div>
                                        <div class="product-card--body">
                                            <div class="card-image">
                                                <?php foreach ($new->product_images as $image) : ?>
                                                    <?php if ($image->is_primary) : ?>
                                                        <img src="<?= $image->image ?>" alt="Product Image">
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                                <div class="hover-contents">
                                                    <a href="product-details.html" class="hover-image">
                                                        <?php foreach ($new->product_images as $image) : ?>
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
                                                <?php if (count($new->product_discount)) : ?>
                                                    <?php foreach ($new->product_discount as $discount) : ?>
                                                        <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                            <span class="price"><?= format_rupiah(get_discount($new->price, $discount->discount_value)) ?></span>
                                                            <del class="price-old"><?= format_rupiah($new->price) ?></del>
                                                            <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                        <?php elseif ($discount->discount_type === "PERCENTAGE") : ?>
                                                            <span class="price"><?= format_rupiah(get_less_price($new->price, $discount->discount_value)) ?></span>
                                                            <del class="price-old"><?= format_rupiah($new->price) ?></del>
                                                            <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                        <?php else : ?>
                                                            <span class="price"><?= format_rupiah($new->price) ?></span>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <span class="price"><?= format_rupiah($new->price) ?></span>
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
                                            NO PRODUCT NEWEST
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
        Home Two Column Section
        ===================================== -->
<section class="bg-gray section-padding-top section-padding-bottom section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb--30 mb-lg--0">
                <div class="home-left-sidebar">
                    <div class="single-side  bg-white">
                        <h2 class="home-sidebar-title">
                            Special offer
                        </h2>
                        <div class="product-slider countdown-single with-countdown sb-slick-slider" data-slick-setting='{
                                        "autoplay": true,
                                        "autoplaySpeed": 8000,
                                        "slidesToShow": 1,
                                        "dots":true
                                    }' data-slick-responsive='[
                                        {"breakpoint":992, "settings": {"slidesToShow": 2} },
                                        {"breakpoint":480, "settings": {"slidesToShow": 1} }
                                    ]'>
                            <?php if (count($offers)) : ?>

                                <?php foreach ($offers as $offer) : ?>
                                    <div class="single-slide">
                                        <div class="product-card">
                                            <div class="product-header">
                                                <span class="author">
                                                    <?= $offer->brand ?  $offer->brand->brand : "No author / brand" ?>
                                                </span>
                                                <h3><a href="product-details.html"><?= $offer->title ?></a></h3>
                                            </div>
                                            <div class="product-card--body">
                                                <div class="card-image">
                                                    <?php foreach ($offer->product_images as $image) : ?>
                                                        <?php if ($image->is_primary) : ?>
                                                            <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                    <div class="hover-contents">
                                                        <a href="product-details.html" class="hover-image">
                                                            <?php foreach ($offer->product_images as $image) : ?>
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
                                                            <a href="#" class="single-btn" id="show_detail_product" data-id="<?= $offer->product_id ?>">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="price-block">
                                                    <?php if (count($offer->product_discount)) : ?>
                                                        <?php foreach ($offer->product_discount as $discount) : ?>
                                                            <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                                <span class="price"><?= format_rupiah(get_discount($offer->price, $discount->discount_value)) ?></span>
                                                                <del class="price-old"><?= format_rupiah($offer->price) ?></del>
                                                                <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                            <?php elseif ($discount->discount_type === "PERCENTAGE") : ?>
                                                                <span class="price"><?= format_rupiah(get_less_price($offer->price, $discount->discount_value)) ?></span>
                                                                <del class="price-old"><?= format_rupiah($offer->price) ?></del>
                                                                <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                            <?php else : ?>
                                                                <span class="price"><?= format_rupiah($offer->price) ?></span>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    <?php else : ?>
                                                        <span class="price"><?= format_rupiah($offer->price) ?></span>
                                                    <?php endif ?>
                                                </div>
                                                <div class="count-down-block">
                                                    <div class="product-countdown" data-countdown="<?= replace_date_to_slash($offer->offers[0]->offer_end) ?>"></div>
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
                                                NO OFFER
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php foreach ($banner_bottom_offer as $bbo) : ?>
                        <div class="single-side">
                            <a href="#" class="promo-image promo-overlay">
                                <img src="<?= $bbo->image ?>" alt="">
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="home-right-block">
                    <div class="single-block bg-white">
                        <div class="section-title mt-0">
                            <h2><?= strtoupper($ct1_name) ?></h2>
                        </div>
                        <div class="product-slider product-list-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                                                                    "autoplay": true,
                                                                    "autoplaySpeed": 8000,
                                                                    "slidesToShow":2,
                                                                    "dots":true
                                                                }' data-slick-responsive='[
                                                                    {"breakpoint":1200, "settings": {"slidesToShow": 2} },
                                                                    {"breakpoint":992, "settings": {"slidesToShow": 2} },
                                                                    {"breakpoint":768, "settings": {"slidesToShow": 2} },
                                                                    {"breakpoint":575, "settings": {"slidesToShow": 1} },
                                                                    {"breakpoint":490, "settings": {"slidesToShow": 1} }
                                                                ]'>
                            <?php if (count($ct1_items)) : ?>
                                <?php foreach ($ct1_items as $ct1) : ?>
                                    <div class="single-slide">
                                        <div class="product-card card-style-list">
                                            <div class="card-image">
                                                <?php foreach ($ct1->product_images as $image) : ?>
                                                    <?php if ($image->is_primary) : ?>
                                                        <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </div>
                                            <div class="product-card--body">
                                                <div class="product-header">
                                                    <span class="author">
                                                        <?= $ct1->brand ?  $ct1->brand->brand : "No author / brand" ?>
                                                    </span>
                                                    <h3><a href="product-details.html"><?= $ct1->title ?></a></h3>
                                                </div>
                                                <div class="price-block">
                                                    <?php if (count($ct1->product_discount)) : ?>
                                                        <?php foreach ($ct1->product_discount as $discount) : ?>
                                                            <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                                <span class="price"><?= format_rupiah(get_discount($ct1->price, $discount->discount_value)) ?></span>
                                                                <del class="price-old"><?= format_rupiah($ct1->price) ?></del>
                                                                <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                            <?php elseif ($discount->discount_type === "PERCENTAGE") : ?>
                                                                <span class="price"><?= format_rupiah(get_less_price($ct1->price, $discount->discount_value)) ?></span>
                                                                <del class="price-old"><?= format_rupiah($ct1->price) ?></del>
                                                                <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                            <?php else : ?>
                                                                <span class="price"><?= format_rupiah($ct1->price) ?></span>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    <?php else : ?>
                                                        <span class="price"><?= format_rupiah($ct1->price) ?></span>
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
                                                NO SLIDE
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="single-block bg-white">
                        <div class="section-title mt-0">
                            <h2><?= strtoupper($ct2_name) ?></h2>
                        </div>
                        <div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                            
                            "autoplaySpeed": 8000,
                            "slidesToShow": 3,
                                        "dots":true
                                    }' data-slick-responsive='[
                                        {"breakpoint":992, "settings": {"slidesToShow": 2} },
                                        {"breakpoint":768, "settings": {"slidesToShow": 2} },
                                        {"breakpoint":480, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":320, "settings": {"slidesToShow": 1} }
                                    ]'>
                            <?php if (count($ct2_items)) : ?>
                                <?php foreach ($ct2_items as $ct2) : ?>
                                    <div class="single-slide">
                                        <div class="product-card">
                                            <div class="product-header">
                                                <span class="author">
                                                    <?= $ct2->brand ?  $ct2->brand->brand : "No author / brand" ?>
                                                </span>
                                                <h3><a href="product-details.html"><?= $ct2->title ?></a></h3>
                                            </div>
                                            <div class="product-card--body">
                                                <div class="card-image">
                                                    <?php foreach ($ct2->product_images as $image) : ?>
                                                        <?php if ($image->is_primary) : ?>
                                                            <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                    <div class="hover-contents">
                                                        <a href="product-details.html" class="hover-image">
                                                            <?php foreach ($ct2->product_images as $image) : ?>
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
                                                    <?php if (count($ct2->product_discount)) : ?>
                                                        <?php foreach ($ct2->product_discount as $discount) : ?>
                                                            <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                                <span class="price"><?= format_rupiah(get_discount($ct2->price, $discount->discount_value)) ?></span>
                                                                <del class="price-old"><?= format_rupiah($ct2->price) ?></del>
                                                                <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                            <?php elseif ($discount->discount_type === "PERCENTAGE") : ?>
                                                                <span class="price"><?= format_rupiah(get_less_price($ct2->price, $discount->discount_value)) ?></span>
                                                                <del class="price-old"><?= format_rupiah($ct2->price) ?></del>
                                                                <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                            <?php else : ?>
                                                                <span class="price"><?= format_rupiah($ct2->price) ?></span>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    <?php else : ?>
                                                        <span class="price"><?= format_rupiah($ct2->price) ?></span>
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
                                                NO SLIDE
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
        CHILDREN’S BOOKS SECTION
        ===================================== -->
<section class="section-margin">
    <div class="container">
        <div class="section-title section-title--bordered">
            <h2><?= strtoupper($ct3_name) ?></h2>
        </div>
        <div class="product-slider product-list-slider slider-border-single-row sb-slick-slider" data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow":3,
                                            "dots":true
                                        }' data-slick-responsive='[
                                            {"breakpoint":1200, "settings": {"slidesToShow": 2} },
                                            {"breakpoint":992, "settings": {"slidesToShow": 2} },
                                            {"breakpoint":575, "settings": {"slidesToShow": 1} },
                                            {"breakpoint":490, "settings": {"slidesToShow": 1} }
                                        ]'>
            <?php if (count($ct3_items)) : ?>
                <?php foreach ($ct3_items as $ct3) : ?>
                    <div class="single-slide">
                        <div class="product-card card-style-list">
                            <div class="card-image">
                                <?php foreach ($ct3->product_images as $image) : ?>
                                    <?php if ($image->is_primary) : ?>
                                        <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                            <div class="product-card--body">
                                <div class="product-header">
                                    <a href="#" class="author">
                                        <?= $ct3->brand ?  $ct3->brand->brand : "No author / brand" ?>
                                    </a>
                                    <h3><a href="product-details.html"><?= $ct3->title ?></a>
                                    </h3>
                                </div>
                                <div class="price-block">
                                    <?php if (count($ct3->product_discount)) : ?>
                                        <?php foreach ($ct3->product_discount as $discount) : ?>
                                            <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                <span class="price"><?= format_rupiah(get_discount($ct3->price, $discount->discount_value)) ?></span>
                                                <del class="price-old"><?= format_rupiah($ct3->price) ?></del>
                                                <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                            <?php elseif ($discount->discount_type === "PERCENTAGE") : ?>
                                                <span class="price"><?= format_rupiah(get_less_price($ct3->price, $discount->discount_value)) ?></span>
                                                <del class="price-old"><?= format_rupiah($ct3->price) ?></del>
                                                <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                            <?php else : ?>
                                                <span class="price"><?= format_rupiah($ct3->price) ?></span>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <span class="price"><?= format_rupiah($ct3->price) ?></span>
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
                                NO SLIDE
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>
<!--=================================
Promotion Section Two
===================================== -->
<section class="section-margin">
    <h2 class="sr-only">Promotion Section</h2>
    <?php foreach ($banner_long_banner as $blb) : ?>
        <div class="container">
            <div class="promo-wrapper promo-type-four">
                <a href="#" class="promo-image promo-overlay bg-image" data-bg="<?= $blb->image ?>">
                </a>
                <div class="promo-text w-100 justify-content-center justify-content-md-left">
                    <div class="row w-100">
                        <div class="col-lg-8">
                            <div class="promo-text-inner">
                                <?php if (!empty($blb->title)) : ?>
                                    <h2><?= $blb->title ?></h2>
                                <?php endif ?>
                                <?php if (!empty($blb->paragraph)) : ?>
                                    <h3><?= $blb->paragraph ?>.</h3>
                                <?php endif ?>
                                <?php if (!empty($blb->link_label)) : ?>
                                    <a href="<?= $blb->link ?>" class="btn btn-outlined--red-faded"><?= $blb->link_label ?></a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    <?php endforeach ?>
</section>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script <?= csp_script_nonce() ?>>
    $(document).on("click", "#show_detail_product", function(e) {
        e.preventDefault();
        const $modal = $(document).find("#quickModal")
        const $id = $(this).data("id");
        const $image = $(document).find("#product_image_modal");
        const $slider_image = $(document).find("#slider_image_modal");
        $.get({
            url: "<?= base_url("/api/data/product") ?>",
            data: {
                id: $id,
            },
            beforeSend: () => {
                $image.slick("destroy");
                $slider_image.slick("destroy");
            },
            success: (data) => {
                if (data != null) {
                    for (let i = 0; i < data.product_images.length; i++) {
                        const images = data.product_images[i];
                        $image.append(`<div class="single-slide">
                            <img src="${images.image}" alt="">
                            </div>`)
                    }
                    for (let i = 0; i < data.product_images.length; i++) {
                        const images = data.product_images[i];
                        $slider_image.append(`<div class="single-slide">
                                    <img src="${images.image}" alt="">
                                </div>`)
                    }

                    $image.slick()
                    $slider_image.slick()
                    $modal.modal("show");
                }
            }
        });

    })
</script>
<?= $this->endSection() ?>