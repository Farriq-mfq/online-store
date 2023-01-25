<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<main class="cart-page-main-block inner-page-sec-padding-bottom">
    <div class="cart_area cart-area-padding  ">
        <div class="container">
            <div class="page-section-title">
                <h1>Shopping Cart</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="<?= base_url('/cart/update') ?>" class="" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <!-- Cart Table -->
                        <div class="cart-table table-responsive mb--40">
                            <?php if (count($carts)) : ?>
                                <table class="table">
                                    <!-- Head Row -->
                                    <thead>
                                        <tr>
                                            <th class="pro-remove"></th>
                                            <th class="pro-thumbnail">Image</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Product Row -->
                                        <?php foreach ($carts as $cart) : ?>
                                            <input type="hidden" name="cart_id[]" value="<?= $cart->session_cart_id ?>">
                                            <tr>
                                                <td class="pro-remove">
                                                    <button class="btn" type="button" id="__delete_cart__session" data-action="<?= base_url("/cart/remove/" . $cart->session_cart_id) ?>"><i class="far fa-trash-alt"></i></button>
                                                </td>
                                                <td class="pro-thumbnail"><a href="#"><img src="<?= $cart->product_img ?>" alt="Product"></a></td>
                                                <td class="pro-title"><a href="#"><?= $cart->product->title ?></a></td>
                                                <td class="pro-price"><span><?= format_rupiah($cart->price) ?></span></td>
                                                <td class="pro-quantity">
                                                    <div class="pro-qty">
                                                        <div class="count-input-block">
                                                            <input type="number" min="0" name="qty[]" class="form-control text-center" value="<?= $cart->quantity ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal"><span><?= format_rupiah($cart->total) ?></span></td>
                                            </tr>
                                        <?php endforeach ?>

                                        <!-- Product Row -->
                                        <!-- Discount Row  -->
                                        <tr>
                                            <td colspan="6" class="actions">
                                                <div class="coupon-block">
                                                    <div class="coupon-text">
                                                        <label for="coupon_code">Coupon:</label>
                                                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code" disabled>
                                                    </div>
                                                    <div class="coupon-btn">
                                                        <input type="submit" class="btn btn-outlined" name="apply_coupon" value="Apply coupon" disabled>
                                                    </div>
                                                </div>
                                                <div class="update-block text-right">
                                                    <button type="submit" class="btn btn-outlined">Update Cart</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <h1>CART EMPTY</h1>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mb--30 mb-lg--0">
                    <!-- slide Block 5 / Normal Slider -->
                    <div class="cart-block-title">
                        <h2>YOU MAY BE INTERESTED IN…</h2>
                    </div>
                    <div class="product-slider sb-slick-slider" data-slick-setting='{
							          "autoplay": true,
							          "autoplaySpeed": 8000,
							          "slidesToShow": 2
									  }' data-slick-responsive='[
                {"breakpoint":992, "settings": {"slidesToShow": 2} },
                {"breakpoint":768, "settings": {"slidesToShow": 3} },
                {"breakpoint":575, "settings": {"slidesToShow": 2} },
                {"breakpoint":480, "settings": {"slidesToShow": 1} },
                {"breakpoint":320, "settings": {"slidesToShow": 1} }
            ]'>
                        <?php if (count($interested)) : ?>
                            <?php foreach ($interested as $interest) : ?>
                                <div class="single-slide">
                                    <div class="product-card">
                                        <div class="product-header">
                                            <a href="#" class="author">
                                                <?= $interest->brand ?  $interest->brand->brand : "No author / brand" ?>
                                            </a>
                                            <h3><a href="<?= base_url('/shop' . '/' . $interest->slug) ?>"><?= $interest->title ?></a></h3>
                                        </div>
                                        <div class="product-card--body">
                                            <div class="card-image">
                                                <?php foreach ($interest->product_images as $image) : ?>
                                                    <?php if ($image->is_primary) : ?>
                                                        <img src="<?= $image->image ?>" alt="Product Image">
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                                <div class="hover-contents">
                                                    <a href="<?= base_url('/shop' . '/' . $interest->slug) ?>" class="hover-image">
                                                        <?php foreach ($interest->product_images as $image) : ?>
                                                            <?php if ($image->is_primary) : ?>
                                                                <img src="<?= $image->image ?>" alt="PRODUCT IMAGE">
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    </a>
                                                    <div class="hover-btns">
                                                        <?php if (auth_user()) : ?>
                                                            <button class="single-btn" id="__btn__add__to__cart" data-id="<?= $interest->product_id ?>"><i class="fas fa-shopping-basket"></i></button>
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
                                                        <a href="#" class="single-btn" id="show_detail_product" data-id="<?= $interest->product_id ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="price-block">
                                                <?php if (count($interest->product_discount)) : ?>
                                                    <?php foreach ($interest->product_discount as $discount) : ?>
                                                        <?php if ($discount->discount_type === "PERCENTAGE") : ?>
                                                            <span class="price"><?= format_rupiah(get_discount($interest->price, $discount->discount_value)) ?></span>
                                                            <del class="price-old"><?= format_rupiah($interest->price) ?></del>
                                                            <span class="price-discount"><?= $discount->discount_value ?>%</span>
                                                        <?php elseif ($discount->discount_type === "VALUE") : ?>
                                                            <span class="price"><?= format_rupiah(get_less_price($interest->price, $discount->discount_value)) ?></span>
                                                            <del class="price-old"><?= format_rupiah($interest->price) ?></del>
                                                            <span class="price-discount"><?= thousandsCurrencyFormat($discount->discount_value) ?></span>
                                                        <?php else : ?>
                                                            <span class="price"><?= format_rupiah($interest->price) ?></span>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <span class="price"><?= format_rupiah($interest->price) ?></span>
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
                                            NO PRODUCT interest
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Cart Summary -->
                <?php if (count($carts)) : ?>
                    <div class="col-lg-6 col-12 d-flex">
                        <div class="cart-summary">
                            <div class="cart-summary-wrap">
                                <h4><span>Cart Summary</span></h4>
                                <p>Sub Total <span class="text-primary"><?= format_rupiah($total_cart->total_cart) ?></span></p>
                                <p>Coupon <span class="text-primary">-</span></p>
                                <h2>Grand Total <span class="text-primary"><?= format_rupiah($total_cart->total_cart) ?></span></h2>
                            </div>
                            <div class="cart-summary-button">
                                <a href="<?= base_url('/checkout') ?>" class="checkout-btn c-btn btn--primary">Checkout</a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    $(document).on("click", "#__delete_cart__session", function(e) {
        e.preventDefault();
        console.log("oks")
        const url = $(this).data("action");
        if (url != undefined && url != "") {
            const isconfirm = confirm("Confirm Your action !")
            if (isconfirm == true) {
                $.ajax({
                    method: "DELETE",
                    url,
                    success: (data) => {
                        if (data.success) {
                            $.toast({
                                heading: "Information",
                                text: "Success delete cart",
                                bgColor: "#62AB00",
                                textColor: "white",
                                icon: "info",
                                showHideTransition: "slide",
                                position: "bottom-left",
                            });

                            setTimeout(() => {
                                window.location.reload()
                            }, 500);
                        }
                    },
                    error: (err) => {
                        $.toast({
                            heading: "Information",
                            text: "Error",
                            bgColor: "#BD0018",
                            textColor: "white",
                            icon: "warning",
                            showHideTransition: "slide",
                            position: "bottom-left",
                        });
                    }
                })
            }
        } else {
            $.toast({
                heading: "Information",
                text: "Action Not Found",
                bgColor: "#BD0018",
                textColor: "white",
                icon: "warning",
                showHideTransition: "slide",
                position: "bottom-left",
            });
        }
    })
</script>
<?= $this->endSection() ?>