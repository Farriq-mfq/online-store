<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="cupon_area">
            <div class="check_title">
                <h2>Have a coupon? <a href="#">Click here to enter your code</a></h2>
            </div>
            <input type="text" placeholder="Enter coupon code">
            <a class="tp_btn" href="#">Apply Coupon</a>
        </div>
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="first" name="name">
                            <span class="placeholder" data-placeholder="First name"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="last" name="name">
                            <span class="placeholder" data-placeholder="Last name"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="number">
                            <span class="placeholder" data-placeholder="Phone number"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="compemailany">
                            <span class="placeholder" data-placeholder="Email Address"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select class="country_select">
                                <option value="1">Country</option>
                                <option value="2">Country</option>
                                <option value="4">Country</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="add1">
                            <span class="placeholder" data-placeholder="Address line 01"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add2" name="add2">
                            <span class="placeholder" data-placeholder="Address line 02"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label>Province</label>
                            <select class="country_select select2" id="province" name="province">
                                <option value=""></option>

                            </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label id="lbl_city">City</label>
                            <select class="country_select select2" id="city" name="city" disabled>
                                <option value=""></option>

                            </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label id="lbl_shipping">Shipping</label>
                            <select class="country_select select2" id="shipping" name="shipping" disabled>
                                <option value=""></option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label id="lbl_shipping_service">Shipping Service</label>
                            <select class="country_select select2" id="shipping_service" name="shipping_service" disabled>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP">
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li><a href="#">Product <span>Total</span></a></li>
                            <?php $subtotal = 0;
                            $total_weight = 0 ?>
                            <?php foreach ($session_cart as $cart) : ?>
                                <li><a href="#"><?= $cart->product->title ?> <span class="middle">x <?= $cart->quantity ?></span> <span class="last">Rp.<?= number_format($cart->total, 0, ",", ".") ?></span></a></li>
                                <?php $subtotal += $cart->total ?>
                                <?php $total_weight += $cart->product->weight ?>
                            <?php endforeach ?>
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Subtotal <span data-value="<?= $subtotal ?>" id="SUBTOTAL_VALUE">Rp.<?= number_format($subtotal, 0, ",", ".") ?></span></a></li>
                            <li><a href="#">Shipping <span id="SHIPPING_VALUE">-</span></a></li>
                            <li><a href="#" data-value=1010>Total <span>$2210.00</span></a></li>
                        </ul>
                        <div class="payment_item" id="bank_transfer">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="payment_option" value="bank_transfer_option">
                                <label for="f-option5">Bank Transfer</label>
                                <div class="check"></div>
                            </div>
                            <div></div>

                            <!-- <label class="mb-2 d-flex align-items-center justify-content-between border border-warning" for="default-radio" style="padding: 0.5rem;border-radius: 5px;">
                                <div class="primary-radio">
                                    <input type="radio" id="default-radio" name="inventory_id">
                                    <label for="default-radio"></label>
                                </div>
                                <span class="ml-2 text-primary">BRI</span>
                            </label>
                            <label class="mb-2 d-flex align-items-center justify-content-between border border-warning" for="default-radio" style="padding: 0.5rem;border-radius: 5px;">
                                <div class="primary-radio">
                                    <input type="radio" id="default-radio" name="inventory_id">
                                    <label for="default-radio"></label>
                                </div>
                                <span class="ml-2 text-primary">MANDIRI</span>
                            </label>
                            <label class="mb-2 d-flex align-items-center justify-content-between border border-warning" for="default-radio" style="padding: 0.5rem;border-radius: 5px;">
                                <div class="primary-radio">
                                    <input type="radio" id="default-radio" name="inventory_id">
                                    <label for="default-radio"></label>
                                </div>
                                <span class="ml-2 text-primary">BCA</span>
                            </label> -->
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="payment_option" value="e_money">
                                <label for="f-option6">E-money</label>
                                <img src="img/product/card.jpg" alt="">
                                <div class="check"></div>
                            </div>
                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                account.</p>
                        </div>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector">
                            <label for="f-option4">I’ve read and accept the </label>
                            <a href="#">terms & conditions*</a>
                        </div>
                        <a class="primary-btn" href="#">Proceed to Paypal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script <?= csp_script_nonce()  ?>>
    // $(window).on('beforeunload', function() {
    //     var c = confirm();
    //     if (c) {
    //         return true;
    //     } else
    //         return false;
    // });

    $.get({
        url: "<?= base_url("/api/shipping/province") ?>",

        success: (data) => {
            for (let i = 0; i < data.length; i++) {
                const province = data[i];
                $("#province").append($("<option>", {
                    value: province.province_id,
                    text: province.province
                }))
            }
        }
    })

    $("#province").change(function(e) {
        $.get({
            url: "<?= base_url("/api/shipping/city") ?>",
            data: {
                province_id: $(this).val()
            },
            beforeSend: () => {
                $("#city option").remove()
                $("#city").attr("disabled", true);
                $("#lbl_city").text("Loading...");
                $("#shipping").attr("disabled", true);
                $("#lbl_shipping").text("Loading...");
            },
            success: (data) => {
                $("#lbl_city").text("city");
                $("#city").attr("disabled", false);
                $("#shipping").attr("disabled", false);
                $("#lbl_shipping").text("Shipping");
                for (let i = 0; i < data.length; i++) {
                    const city = data[i];
                    $("#city").append($("<option>", {
                        value: city.city_id,
                        text: `${city.type} ${city.city_name}`
                    }))
                }
            }
        })
    })
    
    $("#shipping").change(function(e) {
        e.preventDefault();
        $("#shipping_service").attr("disabled", false);
        // $("#shipping_service")
        $.get({
            url: "<?= base_url("/api/shipping/cost") ?>",
            data: {
                destination: $("#city").val(),
                weight:<?= $total_weight ?>,
                courier:$(this).val()
            },
            beforeSend:()=>{
                $("#shipping_service option").remove()
                $("#shipping_service").attr("disabled", true);
                $("#lbl_shipping_service").text("Loading...");
            },
            success:(data)=>{
                $("#shipping_service").attr("disabled", false);
                $("#lbl_shipping_service").text("Shipping Service");
                const res = data.results[0];
                res.costs.forEach(val => {
                    $("#shipping_service").append($("<option>", {
                        value: city.city_id,
                        text: `${val.service} (${val.cost[0].value}) estimation ${val.cost[0].etd}`
                    }))
                    
                });
            }

        })
    })
    $(document).on("click", "input[name='payment_option']", function(e) {
        e.preventDefault();
        if ($(this).is(":checked")) {
            $("#bank_transfer").html(`<label class="mb-2 d-flex align-items-center justify-content-between border border-warning" for="default-radio" style="padding: 0.5rem;border-radius: 5px;">
                                <div class="primary-radio">
                                    <input type="radio" id="default-radio" name="inventory_id">
                                    <label for="default-radio"></label>
                                </div>
                                <span class="ml-2 text-primary">BNI</span>
                            </label>`).fadeIn(2000)
        } else {
            $("#bank_transfer label").remove()
        }
    })
</script>
<?= $this->endSection() ?>