<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                        <?php if ($breadcrumb != "/" && $breadcrumb != "index") : ?>
                            <li class="breadcrumb-item active"><?= strtoupper($breadcrumb) ?></li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ol>
            </nav>
        </div>
    </div>
</section>