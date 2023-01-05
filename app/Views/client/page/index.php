<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<main class="contact_area inner-page-sec-padding-bottom">
    <div class="container">
        <?= html_entity_decode($content) ?>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?>