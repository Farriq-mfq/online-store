<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="dropdown">
<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Menu<span class="caret"></span></button>
    <ul class="dropdown-menu">
        <?php foreach($print_categories as $m): ?>
            <?php if(isset($m['child'])){ ?>
                <li class="dropdown-submenu">
                    <a class="test" href="#"><?php echo $m['category']?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">                      
                        <?php printMenu($print_categories); ?>
                    </ul>
                </li>
                <?php } else {?>
                    <li><a tabindex="-1" href="#"><?php echo $m['category']?></a></li>
                    <?php } ?>
        <?php endforeach ?>
    </ul>
</div>
<pre>
    <?php print_r($categories) ?>
</pre>
    <p>TEST HOME PAGE</p>
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>
    $(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
<?= $this->endSection() ?> 