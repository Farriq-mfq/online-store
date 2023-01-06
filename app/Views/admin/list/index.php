<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" type="button" data-target="#modal-admin">
                    <i class="fas fa-plus"></i>
                    Add new
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $admin) : ?>
                            <tr>
                                <td><?= $admin->name ?></td>
                                <td><?= $admin->email ?></td>
                                <td>
                                    <button class="btn btn-primary btn-sm mb-3" type="button" data-action="<?= admin_url('list/admin/roles/add/' . $admin->admin_id) ?>" id="target_roles"><i class="fa fa-plus"></i></button>
                                    <?php if (count($admin->roles)) : ?>
                                        <ul class="list-group">
                                            <h6>BLOCKED ROLES </h6>
                                            <?php foreach ($admin->roles as $role) : ?>
                                                <li class="list-group-item">
                                                    <span class="badge badge-info">
                                                        <?= $role->role ?>
                                                    </span>
                                                    <div class="d-block mt-2">
                                                        <form action="<?= admin_url("list/admin/roles/remove/" . $role->role_id) ?>" method="POST" onsubmit="return confirm('Confirm Your Action !')">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_admin" type="button" data-id="<?= $admin->admin_id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" confirm data-slug="<?= $admin->name ?>" data-action="<?= admin_url("/list/admin/" . esc($admin->admin_id)) ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-admin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= admin_url("/list/admin") ?>" method="POST" id="list_admin_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" required>Name</label>
                        <input type="text" class="form-control <?= show_class_error("name") ?>" name="name" id="name" value="<?= set_value('name') ?>">
                        <?= show_error("name") ?>
                    </div>
                    <div class="form-group">
                        <label for="email" required>Email</label>
                        <input type="email" class="form-control <?= show_class_error("email") ?>" name="email" id="email" value="<?= set_value('email') ?>">
                        <?= show_error("email") ?>
                    </div>
                    <div class="form-group">
                        <label for="password" required>Password</label>
                        <input type="password" class="form-control <?= show_class_error("password") ?>" name="password" id="password" value="<?= set_value('password') ?>">
                        <?= show_error("password") ?>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" required>Confirm Password</label>
                        <input type="password" class="form-control <?= show_class_error("confirm_password") ?>" name="confirm_password" id="confirm_password" value="<?= set_value('confirm_password') ?>">
                        <?= show_error("confirm_password") ?>
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
<div class="modal fade " id="modal-admin-roles">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="roles_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" required>Select Role</label>
                        <select name="role" id="role" class="form-control select2">
                            <option value="">Select Role</option>
                            <?php foreach ($routes as $key => $route) : ?>
                                <?php if (!$key instanceof \Closure && !$route instanceof \Closure) : ?>
                                    <option value="<?= $route ?>"><?= $key ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
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
    $(document).on("click", "#btn_show_modal_edit_admin", function() {
        const id = $(this).data("id");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/list/admin/get") ?>",
            beforeSend: () => {
                $(this).attr("disabled", true)
            },
            complete: () => {
                $(this).attr("disabled", false)
            },
            success: (data) => {
                console.log(data);
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "ID_METHOD").attr("value", "PUT")
                const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "admin_id").attr("value", data.admin_id)
                $("#list_admin_form").append(input_method)
                $("#list_admin_form").append(input_id)
                $("#name").val(data.name)
                $("#email").val(data.email)
                $("#modal-admin").modal({
                    show: true
                })
                $(".modal-title").text("Update admin")
            }
        })
    })
    // hide
    $("#modal-admin").on("hidden.bs.modal", function() {
        $("#ID_METHOD").remove()
        $("input[name='admin_id']").remove()
        $("#list_admin_form")[0].reset()
        $(".modal-title").text("Add new admin")
        $("#list_admin_form").children().find(".invalid-feedback").remove()
        $("#list_admin_form").children().find(".is-invalid").removeClass("is-invalid")
    })

    $(document).on("click", "#target_roles", function(e) {
        e.preventDefault();
        $("#roles_form").attr("action", $(this).data('action'))
        $("#modal-admin-roles").modal({
            show: true
        });
    })
</script>
<?php if (session()->getFlashdata("validation")) : ?>
    <script>
        $("#modal-admin").modal({
            show: true
        })
    </script>
<?php endif ?>
<?php if (session()->getFlashdata("update_id")) : ?>
    <script>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "ID_METHOD").attr("value", "PUT")
        const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "admin_id").attr("value", "<?= session()->getFlashdata("update_id") ?>")
        $("#list_admin_form").append(input_id)
        $("#list_admin_form").append(input_method)
        $(".modal-title").text("Update admin")
    </script>
<?php endif ?>
<?= $this->endSection() ?>