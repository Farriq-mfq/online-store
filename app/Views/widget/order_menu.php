<li class="nav-item">
    <a href="<?= admin_url("/order") ?>" class="nav-link <?= $active_page == "order/index" ? "active" : "" ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>All</p>
        <span class="right badge badge-primary"><?= $all ?></span>
    </a>
</li>
<li class="nav-item">
    <a href="pages/layout/top-nav.html" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>WAITING</p>
        <span class="right badge badge-info"><?= $waiting ?></span>
    </a>
</li>
<li class="nav-item">
    <a href="pages/layout/top-nav.html" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>PROCESS</p>
        <span class="right badge badge-info"><?= $process ?></span>
    </a>
</li>
<li class="nav-item">
    <a href="pages/layout/top-nav.html" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>SHIPPED</p>
        <span class="right badge badge-warning"><?= $shipped ?></span>
    </a>
</li>
<li class="nav-item">
    <a href="pages/layout/top-nav.html" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>DONE</p>
        <span class="right badge badge-success"><?= $done ?></span>
    </a>
</li>
<li class="nav-item">
    <a href="pages/layout/top-nav.html" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>REJECTED</p>
        <span class="right badge badge-danger"><?= $rejected ?></span>
    </a>
</li>