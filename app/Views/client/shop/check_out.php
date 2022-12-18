<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<p>CHECKOUT PAGE</p>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    $(window).on('beforeunload', function() {
        var c = confirm();
        if (c) {
            return true;
        } else
            return false;
    });
</script>
<?= $this->endSection() ?>