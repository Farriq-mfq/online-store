<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Mail Promo</h4>
            </div>
            <div class="card-body">
                <form action="<?= admin_url("mail/send/promo") ?>" method="POST" id="__form__promo">
                    <div class="form-group">
                        <label required>Subject</label>
                        <input type="text" class="form-control" name="subject">
                    </div>
                    <div class="form-group">
                        <label required>Link (valid link)</label>
                        <input type="text" class="form-control" name="link">
                    </div>
                    <div class="form-group">
                        <textarea name="email_area" id="email_area" cols="30" rows="10" class="form-control"></textarea>
                        <button type="button" id="__grab__btn" class="btn bg-purple mt-2">Grab Email</button>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Result : </h5>
                                <button class="btn btn-sm btn-danger mb-2" id="__click_clear">Clear</button>
                                <ul id="__result" class="list-group">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn bg-teal" id="__btn__send"><i class="fa fa-paper-plane"></i>&nbsp;Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script <?= csp_script_nonce() ?>>
    $("#__grab__btn").on("click", function(e) {
        e.preventDefault();
        const original = $(this).html();
        $.get({
            url: "<?= admin_url("/mail/grab") ?>",
            beforeSend: () => {
                $(this).attr("disabled", true)
                $(this).text("Grabing...")
            },
            success: (data) => {
                $(this).attr("disabled", false)
                $(this).text(original)
                $("#email_area").val("")
                let listEmail = "";
                $.each(data.data, function(key, val) {
                    listEmail += val.email + "\n";
                })
                $("#email_area").val(listEmail)
            },
            error: () => {
                $(this).attr("disabled", false)
                $(this).text(original)
            }
        })
    })

    $("#__click_clear").on('click', function(e) {
        e.preventDefault();
        $("#__result").children().remove()
    })

    $("#__form__promo").on("submit", function(e) {
        e.preventDefault();
        var emails = $('#email_area').val().split(/\r?\n/);
        const original = $("#__btn__send").html();
        $("#email_area").attr("disabled", true)
        $("#__btn__send").attr('disabled', true)
        $("#__btn__send").html("Sending...")
        const link = $("input[name='link']").val();
        const subject = $("input[name='subject']").val();
        $.each(emails, function(key, val) {
            $.post({
                url: "<?= admin_url('mail/send/promo') ?>",
                data: {
                    link,
                    subject,
                    email: val
                },
                cache: false,
                async: false,
                complete: (complete) => {
                    setTimeout(() => {
                        $("#email_area").val(emails.join("\n"))
                        var remove = emails.splice(0, 1);
                        $("#__result").append(`<li class="list-group-item">${remove} ${complete.responseJSON.success ? 'Success':'Failed'}</li>`).hide().show("slow");
                    }, 500);
                }
            })
        })
        setTimeout(() => {
            $("#email_area").attr("disabled", false)
            $("#__btn__send").attr('disabled', false)
            $("#__btn__send").html(original)
        }, 1000);
    });
</script>
<?= $this->endSection() ?>