<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
    <p id="price_format">2000000</p>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?>