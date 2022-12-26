<?= $this->extend("Layouts/main_layout") ?>
<?= $this->section("client_style") ?>
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('client/plugins/select2/css/select2.min.css') ?>" />
<style <?= csp_style_nonce() ?>>
    .radio-shipping-address {
        visibility: hidden;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .select2-container .selection {
        display: block;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Checkout Form s-->
                <form action="<?= base_url("/checkout") ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="checkout-form">
                        <div class="row row-40">
                            <div class="col-12">
                                <h1 class="quick-title">Checkout</h1>
                                <!-- Slide Down Trigger  -->
                                <div class="checkout-quick-box">
                                    <p><i class="far fa-sticky-note"></i>Have a coupon? <a href="javascript:" class="slide-trigger" data-target="#quick-cupon">
                                            Click here to enter your code</a></p>
                                </div>
                                <!-- Slide Down Blox ==> Cupon Box -->
                                <div class="checkout-slidedown-box" id="quick-cupon">
                                    <div class="checkout_coupon">
                                        <input type="text" class="mb-0" placeholder="Coupon Code">
                                        <a href="#" class="btn btn-outlined">Apply coupon</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 mb--20">
                                <?php if (count($addresses)) : ?>
                                    <?php foreach ($addresses as $address) : ?>
                                        <div class="myaccount-content mt-2">
                                            <h3>Address</h3>
                                            <address>
                                                <p><strong><?= $address->user->name ?></strong></p>
                                                <p>1355 Market St, Suite 900 <br>
                                                    San Francisco, CA 94103</p>
                                                <p>Mobile: <?= $address->phone ?></p>
                                            </address>
                                            <div class="d-grid gap-2">
                                                <?php $hashId = randomhash($address->user_address_id) ?>
                                                <input type="radio" class="radio-shipping-address" name="shipping_address" id="radio-shipping-address_<?= $hashId ?>" value="id nya">
                                                <label for="radio-shipping-address_<?= $hashId  ?>" class="btn btn--primary col-md-6"><i class="fa fa-map-marker"></i> Select
                                                    Address</label>
                                                <a href="#" class="btn btn--primary col-md-6"><i class="fa fa-edit"></i>Edit
                                                    Address</a>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <!-- Shipping Address -->
                                    <div class="mb--40 mt-3">
                                        <h4 class="checkout-title">Shipping Address</h4>
                                        <div class="checkout-quick-box">
                                            <p><i class="far fa-map"></i>Hide address ? <a href="javascript:" class="slide-trigger" data-target="#quick-address">
                                                    Click here to Hide address</a></p>
                                        </div>
                                        <div class="row" id="quick-address">
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>First Name*</label>
                                                <input type="text" placeholder="First Name">
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Last Name*</label>
                                                <input type="text" placeholder="Last Name">
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Email Address*</label>
                                                <input type="email" placeholder="Email Address">
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Phone no*</label>
                                                <input type="text" placeholder="Phone number">
                                            </div>
                                            <div class="col-12 mb--20">
                                                <label>Company Name</label>
                                                <input type="text" placeholder="Company Name">
                                            </div>
                                            <div class="col-12 mb--20">
                                                <label>Address*</label>
                                                <input type="text" placeholder="Address line 1">
                                                <input type="text" placeholder="Address line 2">
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Province*</label>
                                                <select id="__load__province__" class="form-control select2" name="province">
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Town/City*</label>
                                                <select id="__load__city__" class="select2 form-control" name="city">
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Zip Code*</label>
                                                <input type="text" placeholder="Zip Code">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="order-note-block mt--30">
                                    <div class="col-md-12 col-12 mb--20">
                                        <label>Devlivery Service*</label>
                                        <select id="__load__delivery__" class="form-control select2" name="province">
                                        </select>
                                    </div>
                                </div>
                                <div class="order-note-block mt--30">
                                    <div class="col-md-12 col-12 mb--20">
                                        <label>Shipping Option*</label>
                                        <select id="__load__shipping____option" class="form-control select2" name="province">
                                        </select>
                                    </div>
                                </div>
                                <div class="order-note-block mt--30">
                                    <label for="order-note">Order notes</label>
                                    <textarea id="order-note" cols="30" rows="10" class="order-note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <!-- Cart Total -->
                                    <div class="col-12">
                                        <div class="checkout-cart-total">
                                            <h2 class="checkout-title">YOUR ORDER</h2>
                                            <h4>Product <span>Total</span></h4>
                                            <ul>
                                                <?php foreach ($carts as $cart) : ?>
                                                    <li><span class="left"><?= $cart->product->title ?> X <?= $cart->quantity ?></span> <span class="right"><?= format_rupiah($cart->total) ?></span></li>
                                                <?php endforeach ?>
                                            </ul>
                                            <p>Sub Total <span><?= format_rupiah($total_cart->total_cart) ?></span></p>
                                            <p>Shipping Fee <span id="__load__shipping__price">-</span></p>
                                            <h4>Grand Total <span id="__load__shipping__grand__total">-</span></h4>
                                            <div class="method-notice mt--25">
                                                <article>
                                                    <h3 class="d-none sr-only">blog-article</h3>
                                                    Sorry, it seems that there are no available payment methods for
                                                    your state. Please contact us if you
                                                    require
                                                    assistance
                                                    or wish to make alternate arrangements.
                                                </article>
                                            </div>
                                            <div class="term-block">
                                                <input type="checkbox" id="accept_terms2">
                                                <label for="accept_terms2">I’ve read and accept the terms &
                                                    conditions</label>
                                            </div>
                                            <button type="submit" class="place-order w-100">Place order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script <?= csp_script_nonce() ?> src="<?= base_url('client/plugins/select2/js/select2.min.js') ?>"></script>
<script>
    $(".select2").select2()

    $(document).on("change", ".radio-shipping-address", function(e) {
        e.preventDefault();
        if ($(this).is(":checked")) {
            $(this).parent().parent().addClass("border-success")
        } else {
            $(this).parent().parent().removeClass("border-success")
        }

    })

    // load province
    $("#__load__province__").load("<?= base_url("/api/shipping/province") ?>")
    $("#__load__province__").change(function(e) {
        e.preventDefault();
        $("#__load__city__").children().remove()
        $("#__load__city__").load("<?= base_url("/api/shipping/city") ?>", `province_id=${$(this).val()}`)
    })

    $("#__load__city__").change(function(e) {
        $("#__load__delivery__").children().remove()
        $("#__load__shipping____option").children().remove()
        const $courier = [{
                text: "Select Delivery Service",
                value: ""
            }, {
                text: "JNE",
                value: "jne"
            },
            {
                text: "TIKI",
                value: "tiki"
            },
            {
                text: "POS",
                value: "pos"
            },
        ];

        $.each($courier, (v, k) => {
            $("#__load__delivery__").append($("<option>", {
                value: k.value,
                text: k.text
            }))
        })
    })

    $("#__load__delivery__").change(function() {
        $("#__load__shipping____option").children().remove()
        $("#__load__shipping____option").load("<?= base_url("/api/shipping/cost") ?>", `destination=${$("#__load__city__").val()}&weight=<?= $total_weight ?>&courier=${$(this).val()}`)
    })

    $("#__load__shipping____option").change(function(e) {
        $("#__load__shipping__price").text("Calculating...")
        $("#__load__shipping__price").load("<?= base_url("api/shipping/get_price") ?>", `service=${$(this).val()}&destination=${$("#__load__city__").val()}&weight=<?= $total_weight ?>&courier=${$("#__load__delivery__").val()}`, function(data, status) {
            if (status == 'error') {
                $("#__load__shipping__price").text("-")
            }
        })
        $("#__load__shipping__grand__total").text("Calculating...")
        $("#__load__shipping__grand__total").load("<?= base_url("api/shipping/get_grand_price") ?>", `service=${$(this).val()}&destination=${$("#__load__city__").val()}&weight=<?= $total_weight ?>&courier=${$("#__load__delivery__").val()}`, function(data, status) {
            if (status == 'error') {
                $("#__load__shipping__grand__total").text("-")
            }
        })
    })
</script>
<?= $this->endSection() ?>