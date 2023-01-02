<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" type="button" data-target="#modal-template">
                    <i class="fas fa-plus"></i>
                    Add new
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>From name</th>
                            <th>From email</th>
                            <th>Recipients</th>
                            <th>Content</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($templates as $template) : ?>
                            <tr>
                                <td><?= $template->from_name ?></td>
                                <td><?= $template->from_email ?></td>
                                <td><?= $template->recipients ?></td>
                                <td><?= html_entity_decode($template->content) ?></td>
                                <td><?= $template->type ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_template" type="button" data-id="<?= $template->template_id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" confirm data-slug="<?= $template->from_name ?>" data-action="<?= admin_url("/mail/template/" . esc($template->template_id)) ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-template">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= admin_url("/mail/template") ?>" method="POST" id="template_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="from_name" required>From name</label>
                        <input type="text" class="form-control <?= show_class_error("from_name") ?>" name="from_name" id="from_name">
                        <?= show_error("from_name") ?>
                    </div>
                    <div class="form-group">
                        <label for="tafrom_emailg" required>From Email</label>
                        <input type="text" class="form-control <?= show_class_error("from_email") ?>" name="from_email" id="from_email">
                        <?= show_error("from_email") ?>
                    </div>
                    <div class="form-group">
                        <label for="recipients">recipients</label>
                        <input type="text" class="form-control <?= show_class_error("recipients") ?>" name="recipients" id="recipients">
                        <?= show_error("recipients") ?>
                    </div>
                    <div class="form-group">
                        <ul class="list-group">
                            CODE INFO
                            <li class="list-group-item"><b>%user%</b>  = name of user</li>
                            <li class="list-group-item"><b>%logo%</b>  = logo website</li>
                            <li class="list-group-item"><b>%link%</b>  = link website</li>
                            <li class="list-group-item"><b>%date%</b>  = date</li>
                            <li class="list-group-item"><b>%total%</b>  = subtotal of transaction</li>
                            <li class="list-group-item"><b>%token%</b>  = orderId</li>
                        </ul>
                        <label required>Content</label>
                        <textarea id="summernote" name="content">
                                <?= set_value("content") ? set_value("content") : "Place <em>some</em> <u>content</u> <strong>here</strong>" ?>
                            </textarea>
                        <?= show_error("content") ?>
                    </div>
                    <div class="form-group">
                        <label required>TYPE</label>
                        <select class="form-control <?= show_class_error("type") ?>" name="type" id="type">
                            <option value="">Select Type</option>
                            <option value="RESET_PASSWORD_USER">RESET PASSWORD USER</option>
                            <option value="ORDER_RECEIVED">ORDER RECEIVED</option>
                            <option value="ORDER_PROCESS">ORDER PROCESS</option>
                            <option value="ORDER_SHIPPED">ORDER SHIPPED</option>
                            <option value="ORDER_DONE">ORDER DONE</option>
                            <option value="ORDER_REJECT">ORDER REJECT</option>
                            <option value="CONFIRM_EMAIL_USER">CONFIRM EMAIL USER</option>
                            <option value="CONFIRM_EMAIL_ADMIN">CONFIRM EMAIL ADMIN</option>
                            <option value="PROMO">PROMO</option>
                        </select>
                        <?= show_error("type") ?>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>
    $(document).on("click", "#btn_show_modal_edit_template", function() {
        const id = $(this).data("id");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/mail/template/get") ?>",
            beforeSend: () => {
                $(this).attr("disabled", true)
            },
            complete: () => {
                $(this).attr("disabled", false)
            },
            success: (data) => {
                console.log(data);
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "ID_METHOD").attr("value", "PUT")
                const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "template_id").attr("value", data.template_id)
                $("#template_form").append(input_method)
                $("#template_form").append(input_id)
                $("#from_name").val(data.from_name)
                $("#from_email").val(data.from_email)
                $("#recipients").val(data.recipients)
                $("#type").val(data.type)
                $("textarea[name='content']").summernote("code", $("textarea[name='content']").html(data.content).val())
                $("#modal-template").modal({
                    show: true
                })
                $(".modal-title").text("Update template")
            }
        })
    })
    // hide
    $("#modal-template").on("hidden.bs.modal", function() {
        $("#ID_METHOD").remove()
        $("input[name='template_id']").remove()
        $("#template_form")[0].reset()
        $(".modal-title").text("Add new template")
        $("#template_form").children().find(".invalid-feedback").remove()
        $("#template_form").children().find(".is-invalid").removeClass("is-invalid")
        $("textarea[name='content']").summernote("code", "Place <em>some</em> <u>content</u> <strong>here</strong>")

    })
</script>
<?php if (session()->getFlashdata("validation")) : ?>
    <script>
        $("#modal-template").modal({
            show: true
        })
    </script>
<?php endif ?>
<?php if (session()->getFlashdata("update_id")) : ?>
    <script>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "ID_METHOD").attr("value", "PUT")
        const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "template_id").attr("value", "<?= session()->getFlashdata("update_id") ?>")
        $("#template_form").append(input_id)
        $("#template_form").append(input_method)
        $(".modal-title").text("Update template")
    </script>
<?php endif ?>
<?= $this->endSection() ?>