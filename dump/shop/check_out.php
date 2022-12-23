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
                    <h3>Address</h3>
                    <form class="row contact_form" action="<?= base_url("/cart/process_to_checkout") ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="items" value="<?= $items ?>">
                        <?php if (count($addreses)) : ?>
                            <div class="col-md-12">
                                <div class="row">
                                    <?php foreach ($addreses as $address) : ?>
                                        <div class="col-md-6 form-group p_star">
                                            <label class="radio_check_component_custom border" for="address_id_<?= $address->user_address_id ?>">
                                                <input type="radio" class="radio_check_component" name="address_id" id="address_id_<?= $address->user_address_id ?>" value="<?= $address->user_address_id ?>">
                                                <p>Name : <?= $address->firstname ?> <?= $address->lastname ?> (<?= $address->phone ?>)</p>
                                                <p>
                                                    <?= $address->address1 ?>
                                                    <?= getCity($address->city)->type ?> <?= getCity($address->city)->city_name ?> , <?= getProvince($address->province)->province ?>
                                                    <br>
                                                    <?= $address->postcode_zip ?>
                                                </p>
                                                <?php if ($address->address2 != null) : ?>
                                                    <p>
                                                        <?= $address->address2 ?>
                                                        <?= getCity($address->city)->type ?> <?= getCity($address->city)->city_name ?> , <?= getProvince($address->province)->province ?>
                                                    </p>
                                                <?php endif ?>
                                                <p><?= $address->address_notes ?></p>
                                            </label>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (count($addreses)) : ?>
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
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                            </div>
                        <?php else : ?>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control <?= show_class_error("firstname", "border-danger") ?>" id="first" placeholder="First name" name="firstname" value="<?= set_value("firstname") ?>">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control <?= show_class_error("lastname", "border-danger") ?>" id="last" placeholder="Last name" name="lastname" value="<?= set_value("lastname") ?>">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="number" min="0" class="form-control <?= show_class_error("phone", "border-danger") ?>" id="number" placeholder="Phone number" name="phone" value="<?= set_value("phone") ?>">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control <?= show_class_error("address1", "border-danger") ?>" id="add1" placeholder="Address line 01" name="address1">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="address2" placeholder="Address line 02">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label class="<?= show_class_error("province", "text-danger") ?>">Province</label>
                                <select class="country_select select2" id="province" name="province">
                                    <option value=""></option>

                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label id="lbl_city" class="<?= show_class_error("city", "text-danger") ?>">City</label>
                                <select class="country_select select2" id="city" name="city">
                                    <option value=""></option>

                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control <?= show_class_error("postcode_zip", "border-danger") ?>" id="zip" name="postcode_zip" placeholder="Postcode/ZIP">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label id="lbl_shipping <?= show_class_error("address2", "text-danger") ?>">Shipping</label>
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
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-md-12 form-group">
                                <textarea class="form-control" name="notes" id="notes" rows="1" placeholder="Order Notes"></textarea>
                            </div>
                        <?php endif ?>

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
                            <li><a href="#">Subtotal <span id="SUBTOTAL_VALUE"><?= $subtotal ?></span></a></li>
                            <li><a href="#">Shipping <span id="SHIPPING_VALUE"></span></a></li>
                            <li><a href="#">Total <span id="TOTAL_VALUE"></span></a></li>
                        </ul>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="payment_option" value="bank_transfer">
                                <label for="f-option5">Bank Transfer</label>
                                <div class="check"></div>
                            </div>
                            <div class="col-md-12 form-group p_star" id="OPTION_PAYMENT">
                                <label class="radio_check_component_custom border" for="PERMATA">
                                    <div class="d-flex">
                                        <h4>PERMATA</h4>
                                    </div>
                                    <input type="radio" class="radio_check_component" name="option_payment" id="PERMATA" value="bank_permata">
                                </label>
                            </div>
                            <div class="col-md-12 form-group p_star" id="OPTION_PAYMENT">
                                <label class="radio_check_component_custom border" for="MANDIRI">
                                    <div class="d-flex">
                                        <h4>MANDIRI</h4>
                                    </div>
                                    <input type="radio" class="radio_check_component" name="option_payment" id="MANDIRI" value="bank_mandiri">
                                </label>
                            </div>
                            <div class="col-md-12 form-group p_star" id="OPTION_PAYMENT">
                                <label class="radio_check_component_custom border" for="BNI">
                                    <div class="d-flex">
                                        <h4>BNI</h4>
                                    </div>
                                    <input type="radio" class="radio_check_component" name="option_payment" id="BNI" value="bank_bni">
                                </label>
                            </div>
                            <div class="col-md-12 form-group p_star" id="OPTION_PAYMENT">
                                <label class="radio_check_component_custom border" for="BRI">
                                    <div class="d-flex">
                                        <h4>BRI</h4>
                                    </div>
                                    <input type="radio" class="radio_check_component" name="option_payment" id="BRI" value="bank_bri">
                                </label>
                            </div>
                            <div class="col-md-12 form-group p_star" id="OPTION_PAYMENT">
                                <label class="radio_check_component_custom border" for="BCA">
                                    <div class="d-flex">
                                        <h4>BCA</h4>
                                    </div>
                                    <input type="radio" class="radio_check_component" name="option_payment" id="BCA" value="bank_bca">
                                </label>
                            </div>
                        </div>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="payment_option" value="e_money">
                                <label for="f-option6">E-money</label>
                                <img src="img/product/card.jpg" alt="">
                                <div class="check"></div>
                            </div>
                            <div class="col-md-12 form-group p_star" id="OPTION_PAYMENT">
                                <label class="radio_check_component_custom border" for="BCA">
                                    <div class="d-flex">
                                        <h4>Qris</h4>
                                    </div>
                                    <input type="radio" class="radio_check_component" name="option_payment" id="Qris" value="qris">
                                </label>
                            </div>
                        </div>
                        <button class="primary-btn btn btn-block" type="submit">Proceed to Paypal</button>
                    </div>
                </div>
            </div>
            </form>
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

    $("#SUBTOTAL_VALUE").number(true, 2, ",", ".");
    $("#SHIPPING_VALUE").number(true, 2, ",", ".");
    $("#TOTAL_VALUE").number(true, 2, ",", ".");


    <?php if (count($addreses)) : ?>
        let get_data = null;
        $("input[name='address_id']").on("change", function(e) {
            e.preventDefault();
            if ($(this).is(":checked")) {
                $.get({
                    url: "<?= base_url("/cart/get_user_address") ?>",
                    data: {
                        "user_address_id": $(this).val()
                    },
                    beforeSend: () => {
                        $("#shipping_service option").remove()
                        $("#shipping_service").attr("disabled", true);
                        $("#shipping").attr("disabled", true);
                        $("#lbl_shipping").text("Loading...");
                    },
                    success: (data) => {
                        $("#shipping").attr("disabled", false);
                        $("#lbl_shipping").text("Shipping");
                        get_data = data;
                    }
                })
            }
        })
        $("#shipping").change(function(e) {
            e.preventDefault();
            $("#shipping_service").attr("disabled", false);
            $.get({
                url: "<?= base_url("/api/shipping/cost") ?>",
                data: {
                    destination: get_data != null ? get_data.city : 0,
                    weight: <?= $total_weight ?>,
                    courier: $(this).val()
                },
                beforeSend: () => {
                    $("#shipping_service option").remove()
                    $("#shipping_service").attr("disabled", true);
                    $("#lbl_shipping_service").text("Loading...");
                },
                success: (data) => {
                    $("#shipping_service").attr("disabled", false);
                    $("#lbl_shipping_service").text("Shipping Service");
                    const res = data.results[0];
                    res.costs.forEach(val => {
                        $("#shipping_service").append($("<option>", {
                            value: val.service,
                            text: `${val.service} (${val.cost[0].value}) estimation ${val.cost[0].etd}`
                        }))

                    });
                }

            })
        })

    <?php else : ?>
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
                    $("#shipping_service option").remove()
                    $("#shipping_service").attr("disabled", true);
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
        $("#city").change(function(e) {
            e.preventDefault();
            $("#shipping_service option").remove()
            $("#shipping_service").attr("disabled", true);
        });
        $("#shipping").change(function(e) {
            e.preventDefault();
            $("#shipping_service").attr("disabled", false);
            $.get({
                url: "<?= base_url("/api/shipping/cost") ?>",
                data: {
                    destination: $("#city").val(),
                    weight: <?= $total_weight ?>,
                    courier: $(this).val()
                },
                beforeSend: () => {
                    $("#shipping_service option").remove()
                    $("#shipping_service").attr("disabled", true);
                    $("#lbl_shipping_service").text("Loading...");
                },
                success: (data) => {
                    $("#shipping_service").attr("disabled", false);
                    $("#lbl_shipping_service").text("Shipping Service");
                    const res = data.results[0];
                    res.costs.forEach(val => {
                        $("#shipping_service").append($("<option>", {
                            value: val.service,
                            text: `${val.service} (${val.cost[0].value}) estimation ${val.cost[0].etd}`
                        }))

                    });
                }

            })
        })


    <?php endif ?>
    $("#shipping_service").on("change", function(e) {
        e.preventDefault();
        $("#SHIPPING_VALUE").text($(this).val())

        console.log($(this).attr("data-value"))
    })

    $(".payment_item").children("#OPTION_PAYMENT").css("display", 'none');
    $("input[name='payment_option']").change(function(e) {
        e.preventDefault();
        $(".payment_item").children("#OPTION_PAYMENT").css("display", 'none');
        switch ($(this).val()) {
            case "bank_transfer":
                $(this).parent().parent().children("#OPTION_PAYMENT").css("display", "block")
                break;
            case "e_money":
                $(this).parent().parent().children("#OPTION_PAYMENT").css("display", "block")
                console.log("EMONTY")
                break;

            default:
                console.log("NOT SELECTED")
                break;
        }
    })
</script>
<?= $this->endSection() ?>