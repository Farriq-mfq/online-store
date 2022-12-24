<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores commodi est, cum accusamus qui blanditiis nesciunt maiores pariatur ducimus nisi nam at porro aspernatur voluptatem aliquid expedita velit earum. Eligendi!</p>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?>