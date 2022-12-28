<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>

<div class="page-section inner-page-sec-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- My Account Tab Menu Start -->
                    <div class="col-lg-3 col-12">
                        <div class="myaccount-tab-menu nav" role="tablist">
                            <a id="__tab__click" data-target="dashboard" href="#dashboad" <?php if ($target_tab == "dashboard") : ?>class="active" <?php endif ?> data-bs-toggle="tab"><i class="fas fa-tachometer-alt"></i>
                                Dashboard</a>
                            <a id="__tab__click" data-target="orders" href="#orders" <?php if ($target_tab == "orders") : ?>class="active" <?php endif ?> data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                            <a id="__tab__click" data-target="download" href="#download" <?php if ($target_tab == "download") : ?>class="active" <?php endif ?> data-bs-toggle="tab"><i class="fas fa-download"></i> Download</a>
                            <a id="__tab__click" data-target="payment-method" href="#payment-method" <?php if ($target_tab == "payment-method") : ?>class="active" <?php endif ?> data-bs-toggle="tab"><i class="fa fa-credit-card"></i>
                                Payment
                                Method</a>
                            <a id="__tab__click" data-target="address-edit" href="#address-edit" <?php if ($target_tab == "address-edit") : ?>class="active" <?php endif ?> data-bs-toggle="tab"><i class="fa fa-map-marker"></i>
                                address</a>
                            <a id="__tab__click" data-target="account-info" href="#account-info" <?php if ($target_tab == "account-info") : ?>class="active" <?php endif ?> data-bs-toggle="tab"><i class="fa fa-user"></i> Account
                                Details</a>
                            <form action="<?= base_url('auth/logout') ?>" onsubmit="return confirm('Confirm Your Action !')" method="POST" class="nav-link border btn btn-block d-flex" style="justify-content: start;padding: 0 1.5rem;">
                                <?= csrf_field() ?>
                                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </div>
                    </div>
                    <!-- My Account Tab Menu End -->
                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade <?php if ($target_tab == "dashboard") : ?>show active<?php endif ?>" id="dashboad" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Dashboard</h3>
                                    <div class="welcome mb-20">
                                        <p>Hello, <strong><?= $user->name ?></strong></p>
                                    </div>
                                    <p class="mb-0">From your account dashboard. you can easily check &amp; view
                                        your
                                        recent orders, manage your shipping and billing addresses and edit your
                                        password and account details.</p>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade <?php if ($target_tab == "orders") : ?>show active<?php endif ?>" id="orders" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Orders</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Order Id</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Payment status</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                <?php foreach ($orders as $key =>  $order) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $order->token ?></td>
                                                        <td><?= $order->created_at ?></td>
                                                        <td><?= $order->status ?></td>
                                                        <td><?= $payments[$key]->transaction_status ?></td>
                                                        <td><?= format_rupiah($order->subtotal) ?></td>
                                                        <td><a href="<?= base_url('/account/view?token=' . $order->token) ?>" class="btn">View</a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade <?php if ($target_tab == "download") : ?>show active<?php endif ?>" id="download" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Downloads</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Order id</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orders as $order) : ?>
                                                    <tr>
                                                        <td><?= $order->token ?></td>
                                                        <td><?= $order->created_at ?></td>
                                                        <td><?= $order->status ?></td>
                                                        <td><a href="<?= base_url('/checkout/complete?token=' . $order->token) ?>" class="btn">Download</a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade <?php if ($target_tab == "payment-method") : ?>show active<?php endif ?>" id="payment-method" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Payment Method</h3>
                                    <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade <?php if ($target_tab == "address-edit") : ?>show active<?php endif ?>" id="address-edit" role="tabpanel">
                                <button type="button" id="__show__modal__address" class="btn btn--primary mb-2"><i class="fa fa-plus"></i>&nbsp;Add
                                    Address</button>
                                <?php if (count($addresses)) : ?>
                                    <?php foreach ($addresses as $address) : ?>

                                        <div class="myaccount-content mt-2 <?php if ($address->primary) : ?>border-success<?php endif ?>">
                                            <h3>Address</h3>
                                            <address>
                                                <p><strong><?= $address->user->name ?></strong></p>
                                                <p><?= $address->address1 ?>, <br>
                                                    <?= getCity($address->city)->city_name ?>, <?= getProvince($address->province)->province ?> <?= $address->postcode_zip ?></p>
                                                <p>Phone: <?= $address->phone ?></p>
                                            </address>
                                            <div class="d-grid gap-2">
                                                <button type="button" id="__show__modal__address" data-id="<?= $address->user_address_id ?>" class="btn btn--primary mb-2" style="display: inline;"><i class="fa fa-edit"></i>&nbsp;Change
                                                    Address</button>
                                                <?php if (!$address->primary) : ?>
                                                    <form action="<?= base_url('account/address/default/' . $address->user_address_id) ?>" method="POST">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn--primary col-md-6" id="__change__address__modal">Use as default address</button>
                                                    </form>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <p>No address here</p>
                                <?php endif ?>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade <?php if ($target_tab == "account-info") : ?>show active<?php endif ?>" id="account-info" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Account Details</h3>
                                    <div class="account-details-form">
                                        <form action="<?= base_url('account/update') ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <div class="row">
                                                <div class="col-12  mb--30">
                                                    <input id="display-name" placeholder="Display Name" type="text" value="<?= $user->name ?>" name="name" class="<?= show_class_error('name') ?>">
                                                    <?= show_error('name') ?>
                                                </div>
                                                <div class="col-12  mb--30">
                                                    <input id="email" placeholder="Email Address" type="email" value="<?= $user->email ?>" name="email" class="<?= show_class_error('email') ?>">
                                                    <?= show_error('email') ?>
                                                </div>
                                                <div class="col-12  mb--30">
                                                    <h4>Password change</h4>
                                                </div>
                                                <div class="col-12  mb--30">
                                                    <input id="current-pwd" placeholder="Current Password" type="password" name="current_password" class="<?= show_class_error('current_password') ?>">
                                                    <?= show_error('current_password') ?>
                                                </div>
                                                <div class="col-lg-6 col-12  mb--30">
                                                    <input id="new-pwd" placeholder="New Password" type="password" name="new_password" class="<?= show_class_error('new_password') ?>">
                                                    <?= show_error('new_password') ?>
                                                </div>
                                                <div class="col-lg-6 col-12  mb--30">
                                                    <input id="confirm-pwd" placeholder="Confirm Password" type="password" name="confirm_password" class="<?= show_class_error('confirm_password') ?>">
                                                    <?= show_error('confirm_password') ?>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn--primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                        </div>
                    </div>
                    <!-- My Account Tab Content End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade modal-quick-view" id="__address__modal" tabindex="-1" role="dialog" aria-labelledby="__address__modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div style="padding: 2rem;">
                <div class="mb--40 mt-3">
                    <h4 class="checkout-title">Shipping Address</h4>
                    <form action="<?= base_url("account/address") ?>" method="POST" id="__form__address">
                        <?= csrf_field() ?>
                        <div class="row" id="quick-address">
                            <div class="col-md-6 col-12 mb--20 form-group">
                                <label>First Name*</label>
                                <input type="text" placeholder="First Name" class="form-control <?= show_class_error("firstname") ?>" name="firstname" value="<?= set_value('firstname') ?>">
                                <?= show_error('firstname') ?>
                            </div>
                            <div class="col-md-6 col-12 mb--20 form-group">
                                <label>Last Name*</label>
                                <input type="text" placeholder="Last Name" class="form-control <?= show_class_error('lastname') ?>" name="lastname" value="<?= set_value('lastname') ?>">
                                <?= show_error('lastname') ?>
                            </div>
                            <div class="col-md-12 col-12 mb--20 form-group">
                                <label>Phone no*</label>
                                <input type="text" placeholder="Phone number" class="form-control <?= show_class_error('phone') ?>" name="phone" value="<?= set_value('phone') ?>">
                                <?= show_error('phone') ?>
                            </div>
                            <div class="col-12 mb--20 form-group">
                                <label>Address*</label>
                                <input type="text" placeholder="Address line 1" class="form-control <?= show_class_error('address1') ?>" name="address1" value="<?= set_value('address1') ?>">
                                <?= show_error('address1') ?>
                                <input type="text" placeholder="Address line 2" class="form-control" name="address2">
                            </div>
                            <div class="col-md-6 col-12 mb--20 form-group">
                                <label>Province*</label>
                                <select id="__load__province__" class="form-control <?= show_class_error('province') ?>" name="province">
                                </select>
                                <?= show_error('province') ?>
                            </div>
                            <div class="col-md-6 col-12 mb--20 form-group">
                                <label>Town/City*</label>
                                <select id="__load__city__" class="form-control <?= show_class_error('city') ?>" name="city">
                                </select>
                                <?= show_error('city') ?>
                            </div>
                            <div class="col-md-12 col-12 mb--20 form-group">
                                <label>Zip Code*</label>
                                <input type="text" placeholder="Zip Code" class="form-control <?= show_class_error('postcode_zip') ?>" name="postcode_zip" value="<?= set_value('postcode_zip') ?>">
                                <?= show_error('postcode_zip') ?>
                            </div>
                            <div class="col-md-12 col-12 mb--20 form-group">
                                <label for="order-note">Address notes</label>
                                <textarea id="order-note" cols="30" rows="10" class="form-control" name="address_notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary mb-2"><i class="fa fa-plus"></i>&nbsp;Add
                                    Address</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    $(document).on("click", "#__tab__click", function(e) {
        e.preventDefault();
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.set("tab", $(this).data('target'));
        let newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + searchParams.toString();
        window.history.pushState({
            path: newurl
        }, '', newurl);
    })

    $(document).on("click", "#__show__modal__address", function(e) {
        e.preventDefault();
        $("#__load__province__").load("<?= base_url("/api/shipping/province") ?>")

        if ($(this).data('id')) {
            const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "__id_address").attr("id", "__id_address").attr("value", $(this).data('id'))
            $("#__form__address").append(input_id)
            $.get({
                url: "<?= base_url('account/address/edit') ?>",
                data: {
                    id: $(this).data('id')
                },
                success: (data) => {
                    $("input[name='firstname']").val(data.firstname);
                    $("input[name='lastname']").val(data.lastname);
                    $("input[name='phone']").val(data.phone);
                    $("input[name='address1']").val(data.address1);
                    $("input[name='address2']").val(data.address2);
                    $("input[name='province']").val(data.province);
                    $("input[name='city']").val(data.city);
                    $("input[name='postcode_zip']").val(data.postcode_zip);
                    $("input[name='address_notes']").val(data.address_notes);
                    $("#__address__modal").modal("show")

                }
            })
        } else {
            $("#__address__modal").modal("show")
        }
    })
    $("#__load__province__").change(function(e) {
        e.preventDefault();
        $("#__load__city__").children().remove()
        $("#__load__city__").load("<?= base_url("/api/shipping/city") ?>", `province_id=${$(this).val()}`)
    })

    $("#__address__modal").on("hidden.bs.modal", function() {
        $("#__form__address").children("#__id_address").remove()
        $("#__form__address")[0].reset()
    });
    <?php if (session()->getFlashdata('show_modal')) : ?>
        $(window).load(function() {
            $('#__address__modal').modal('show');
        });
    <?php endif ?>
</script>
<?= $this->endSection() ?>