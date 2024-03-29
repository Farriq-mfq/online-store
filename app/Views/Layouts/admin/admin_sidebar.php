<?php

use Config\Services;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link text-center">
    <span class="brand-text font-bold">PANEL ADMIN</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><?= Services::authserviceAdmin()->getSessionData()['email'] ?></a>
        <?php if (admin()['role'] == 'DEV') : ?>
          <span class="text-white">DEVELOPER MODE</span>
        <?php endif ?>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= admin_url("/") ?>" class="nav-link <?= $active_page == "/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">MANAGEMENT PRODUCT</li>
        <li class="nav-item <?= str_contains($active_page, "product") ? "menu-open" : "" ?>">
          <a href="#" class="nav-link <?= str_contains($active_page, "product") ? "active" : "" ?>">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Products
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= admin_url("/product") ?>" class="nav-link <?= $active_page == "product/index" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>All Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/product/new") ?>" class="nav-link <?= $active_page == "product/new" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/product/inventories") ?>" class="nav-link <?= $active_page == "product/inventories" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Inventories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/product/images") ?>" class="nav-link <?= $active_page == "product/images" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Images</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/product/comments") ?>" class="nav-link <?= $active_page == "product/comments" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Comments</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/product/reviews") ?>" class="nav-link <?= $active_page == "product/reviews" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Reviews</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/product/tags") ?>" class="nav-link <?= $active_page == "product/tags" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Tags</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/product/meta") ?>" class="nav-link <?= $active_page == "product/meta" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Meta & SEO</p>
              </a>
            <li class="nav-item">
              <a href="<?= admin_url("/product/discount") ?>" class="nav-link <?= $active_page == "product/discount" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Discount</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">MASTER</li>
        <li class="nav-item">
          <a href="<?= admin_url("/brands") ?>" class="nav-link <?= $active_page == "brands/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Brands
            </p>
          </a>
        </li>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url("/categories") ?>" class="nav-link <?= $active_page == "categories/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Categories
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url("/tags") ?>" class="nav-link <?= $active_page == "tags/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Tags
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url("/page") ?>" class="nav-link <?= $active_page == "page/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Page Content
            </p>
          </a>
        </li>
        </li>
        <li class="nav-header">MANAGEMENT ORDER</li>
        <li class="nav-item <?= str_contains($active_page, "order") ? "menu-open" : "" ?>">
          <a href="#" class="nav-link <?= str_contains($active_page, "order") ? "active" : "" ?>">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Orders
            </p>
            <i class="fas fa-angle-left right"></i>
          </a>
          <ul class="nav nav-treeview">
            <?= view_cell('\App\Libraries\Admin::renderOrderMenu') ?>
          </ul>
        </li>
        <li class="nav-header">MANAGEMENT PROMOTION</li>
        <li class="nav-item">
          <a href="<?= admin_url("/slider") ?>" class="nav-link <?= $active_page == "slider/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-image"></i>
            <p>
              Sliders
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url("/banner") ?>" class="nav-link <?= $active_page == "banner/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-image"></i>
            <p>
              Banner
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url("/offer") ?>" class="nav-link <?= $active_page == "offer/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-tag"></i>
            <p>
              Special Offers
            </p>
          </a>
        </li>
        <li class="nav-header">Reports</li>
        <li class="nav-item <?= str_contains($active_page, "report") ? "menu-open" : "" ?>">
          <a href="#" class="nav-link <?= str_contains($active_page, "report") ? "active" : "" ?>">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Reports
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= admin_url("/report") ?>" class="nav-link <?= $active_page == "report/index" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Income Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/report/visitor") ?>" class="nav-link <?= $active_page == "report/visitor" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Visitor perweek</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/report/user_regis") ?>" class="nav-link <?= $active_page == "report/user" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>User registration Reports</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= admin_url("/report/product_sales") ?>" class="nav-link <?= $active_page == "report/product_sales" ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Sales Report</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">MANAGEMENT WEBSITE</li>
        <li class="nav-item">
          <a href="<?= admin_url("/website") ?>" class="nav-link <?= $active_page == "website/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Website Setting
            </p>
          </a>
        </li>
        <li class="nav-header">EMAIL MANAGEMENT</li>
        <li class="nav-item">
          <a href="<?= admin_url("/mail") ?>" class="nav-link <?= $active_page == "mail/index" ? "active" : "" ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              SMTP Setting
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url("/mail/send/testing") ?>" class="nav-link <?= $active_page == "mail/testing" ? "active" : "" ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Email Testing
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url("/mail/send/promo") ?>" class="nav-link <?= $active_page == "mail/promo" ? "active" : "" ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Email Promo
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url("/mail/template") ?>" class="nav-link <?= $active_page == "mail/template" ? "active" : "" ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Email Template
            </p>
          </a>
        </li>
        <?php if (admin()['role'] == 'DEV') : ?>
          <li class="nav-header">MANAGEMENT ADMIN</li>
          <li class="nav-item">
            <a href="<?= admin_url("/list/admin") ?>" class="nav-link <?= $active_page == "list/admin/index" ? "active" : "" ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                List Admin
              </p>
            </a>
          </li>
          <li class="nav-header">MANAGEMENT DATABASE</li>
          <li class="nav-item">
            <a href="<?= admin_url("/backup") ?>" class="nav-link <?= $active_page == "backup/index" ? "active" : "" ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Backup Database
              </p>
            </a>
          </li>
        <?php endif ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>