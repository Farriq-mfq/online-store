<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Mail Testing
                </h4>
            </div>
            <div class="card-body">
                <form action="<?= admin_url("/mail/send/testing") ?>" method="POST" id="__FORM_TEST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info" id="BTN_TEST"><i class="fa fa-industry"></i> Run</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>
    $("#__FORM_TEST").on("submit", function(e) {
        e.preventDefault();
        const $original = $("#BTN_TEST").html();
        $.post({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            beforeSend: () => {
                $("#BTN_TEST").text("Running...");
                $("#BTN_TEST").attr("disabled", true);
            },
            success: (data) => {
                $("#BTN_TEST").html($original);
                $("#BTN_TEST").attr("disabled", false);
                if (data.success) {
                    swal.fire({
                        title: "Success",
                        icon: "success",
                        text: "Send Test Success"
                    })
                } else {
                    swal.fire({
                        title: "Mail Error",
                        icon: "error",
                        text: "Send mail error"
                    })
                }
            },
            error: (err) => {
                $("#BTN_TEST").html($original);
                $("#BTN_TEST").attr("disabled", false);
                swal.fire({
                    title: "Error",
                    icon: "error",
                    text: err.responseJSON.validation.email
                })
            }
        })
    })
</script>
<?= $this->endSection() ?>