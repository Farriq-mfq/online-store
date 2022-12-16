<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
    <p>THAT HOME PAGE</p>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?>