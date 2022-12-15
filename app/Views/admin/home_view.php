<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<ul>
    <li>
        <a href="">Ct 1</a>
        <ul>
            <li>
                <a href="">CT CHILD</a>
                <ul>
                    <li>
                        <a href="">fkdskflsdjfkl</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>CT</td>
            <td>    
                <?= printMenu($categories) ?>
            </td>
        </tr>
    </tbody>
</table>
<pre>
    <?php print_r(printMenu($categories)) ?>
</pre>
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