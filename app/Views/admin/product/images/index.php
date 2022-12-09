<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Images</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                            <tr>
                                <td>
                                    <?= $product->title ?> 
                                    <button class="btn btn-sm btn-primary" id="PLUS_IMAGES" type="button" data-id="<?= $product->product_id ?>" data-action="<?= admin_url("/product/images/".$product->product_id) ?>"><i class="fas fa-plus"></i></button> 
                                </td>
                                <td>
                                    <div class="row">
                                        <?php foreach($product->product_images as $image): ?>
                                            <div class="col-md-4">
                                                <div class="card <?php if($image->is_primary):?>border border-primary<?php endif ?>">
                                                    <div class="card-body">
                                                        <img src="<?= $image->image ?>" alt="" class="img-thumbnail img-responsive">
                                                    </div>
                                                    <div class="card-footer">
                                                    <button class="btn btn-sm btn-primary" type="button" data-id="<?= $image->image_id ?>"  data-action="<?= admin_url("/product/images/".$image->image_id) ?>" id="BTN_EDIT_IMAGES"><i class="fas fa-edit"></i></button> 
                                <button class="btn btn-danger btn-sm" confirm  data-slug="<?= $image->mime ?>" data-action="<?= admin_url("/product/images/".esc($image->image_id)) ?>"><i class="fas fa-trash"></i></button>
                                                    <?php if(!$image->is_primary): ?>
                                                    <form method="POST" class="d-inline" action="<?= admin_url("/product/images/".$image->image_id."/primary") ?>">
                                                    <?php csrf_field() ?>
                                                        <button class="btn btn-warning btn-sm" type="submit"><i class="fas fa-star"></i></button>
                                                    </form>
                                                    <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-images">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="FORM_images" action="<?= session()->getFlashdata("action_session_images")?session()->getFlashdata("action_session_images"):""?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label required>Images</label>
                        <input type="file" class="form-control <?= show_class_error("image") ?>" name="image" id="image">    
                        <?= show_error("image") ?>
                    </div>
                    <div class="form-group">
                        <img src="#" class="img-thumbnail" alt="No Preview" id="IMAGE_PREVIEW">
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Save</button>
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
    $(document).on("click","#PLUS_IMAGES",function(e){
        e.preventDefault();
        $("#modal-images").modal({show:true})
        $("#FORM_images").attr("action",$(this).data('action'))
    })
    
    $("#modal-images").on("hidden.bs.modal",function(){
        $("#FORM_images")[0].reset()
        $("#IMAGE_METHOD_SPOFF").remove()
        $("#FORM_images").children().find(".invalid-feedback").remove()
        $("#IMAGE_PREVIEW").attr("src","")
        $("#FORM_images").children().find(".is-invalid").removeClass("is-invalid")
    })

    $(document).on("click","#BTN_EDIT_IMAGES",function(e){
        e.preventDefault();
        const id = $(this).data("id");
        const action = $(this).data("action");
        $.ajax({
           method:"GET",
           data:{id:id},
           url:"<?= admin_url("/product/images/edit") ?>",
           success:(data)=>{
            const input_method = $(document.createElement("input")).attr("type","hidden").attr("name","_method").attr("id","IMAGE_METHOD_SPOFF").attr("value","PUT")
            $("#FORM_images").append(input_method)
            $("#FORM_images").attr("action",action)
            $("#IMAGE_PREVIEW").attr("src",data.image)
            $("#modal-images").modal({show:true})
           }
        })
    })
    $("#image").on("change",function(e){
        const reader = new FileReader();
        reader.onload = ()=>{
            $("#IMAGE_PREVIEW").attr("src",reader.result)
        }

        reader.readAsDataURL(e.target.files[0])
    })
    <?php if(session()->getFlashdata("METHOD_UPDATE_SESSION")): ?>
        const input_method = $(document.createElement("input")).attr("type","hidden").attr("name","_method").attr("id","IMAGES_METHOD_SPOFF").attr("value","PUT")
        $("#FORM_images").append(input_method)
    <?php endif ?>
    
    <?php if(session()->getFlashdata("validation")): ?>
        $("#modal-images").modal({show:true})
    <?php endif ?>
</script>
<?= $this->endSection() ?> 