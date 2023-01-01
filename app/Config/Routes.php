<?php

namespace Config;

use App\Controllers\Admin\AuthController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/* USER ROUTES */
$routes->group("shop", ['filter' => 'visitor'], function ($route) {
    $route->get('/', 'ShopControlller::index');
    $route->get('(:segment)', 'ShopControlller::detail/$1');
    $route->post('(:segment)/review', 'ShopControlller::postReviews/$1');
});
$routes->group("cart", ["filter" => "user"], function ($route) {
    $route->get("/", "WebCartController::index");
    $route->put("update", "WebCartController::updateCart");
    $route->delete("remove/(:num)", "WebCartController::removeCart/$1");
});
$routes->group("checkout", ["filter" => "user"], function ($route) {
    $route->get("/", "CheckOutController::index");
    $route->post("/", "OrderController::do_order");
    $route->post("changeaddress/(:num)", "CheckOutController::change_address/$1");
    $route->get("complete", "CheckOutController::complete");
});
$routes->group("order", ["filter" => "user"], function ($route) {
    $route->post("cencel/(:num)", "OrderController::cencel/$1");
    $route->post("done/(:num)", "OrderController::done/$1");
    $route->post("download/(:num)", "OrderController::generate_pdf/$1");
});
$routes->group("account", ["filter" => "user"], function ($route) {
    $route->get("/", "AccountController::index");
    $route->post("address", "AccountController::add_address");
    $route->post("address/default/(:num)", "AccountController::set_address_default/$1");
    $route->post("address/remove/(:num)", "AccountController::remove_address/$1");
    $route->get("address/edit", "AccountController::set_address_edit");
    $route->post("update", "AccountController::account_update");
    $route->get("view", "AccountController::view");
});
$routes->group("api/cart", ["filter" => "user"], function ($route) {
    $route->get("/", "CartController::index");
    $route->post("add", "CartController::add_to_cart");
    $route->get("count", "CartController::show_count_cart");
    $route->get("total_price", "CartController::show_total_price_cart");
    $route->post("remove", "CartController::remove_cart");
});
$routes->group("auth", ["filter" => "user-guest"], function ($route) {
    $route->get('/', 'AuthController::index');
    $route->post('login', 'AuthController::login');
    $route->post('register', 'AuthController::register');
    $route->get('reset', 'AuthController::resetPassword');
    $route->post('reset/send', 'AuthController::resetPasswordSend');
    $route->get('verification', 'AuthController::verif');
    $route->post('password/change/(:segment)', 'AuthController::change_password/$1');
    $route->get('email/verification', 'AuthController::email_verif');
    $route->post('resend/email/confirmation/(:num)', 'AuthController::resend_email_confirmation/$1');
});
// auth logout
$routes->post('auth/logout', "AuthController::logout", ["filter" => "user"]);

$routes->group("api/shipping", ['filter' => 'user'], function ($route) {
    $route->get("city", "ShippingController::cityByprovice");
    $route->get("province", "ShippingController::getProvince");
    $route->get("cost", "ShippingController::getCost");
    $route->get("get_price", "ShippingController::getPrice");
    $route->get("get_grand_price", "ShippingController::getGrand");
});

$routes->get("/", "Home::index", ['filter' => 'visitor']);

$routes->group("api/data", function ($route) {
    $route->get("product", "ApiController::get_product");
    $route->get("load/product", "ApiController::index");
});


/* ADMIN ROUTES */
$routes->group("/" . ADMIN_PATH, ["namespace" => $routes->getDefaultNamespace() . "Admin", "filter" => ["admin-auth", "roles-auth"]], function ($route) {
    $route->get("/", "HomeController::index");
    $route->get("api/home/getvisitor_today", "HomeController::apiGetVisitorToday");
    $route->get("api/home/getsales_today", "HomeController::apiGetSalesToday");
    /* PRODUCT ROUTES */
    $route->group("product", function ($route) {
        $route->get("/", "ProductController::index");
        // product add new
        $route->get("new", "ProductController::create");
        $route->post("new", "ProductController::add");
        // product delete
        $route->delete("(:num)", "ProductController::remove/$1");
        $route->get("(:num)/edit", "ProductController::edit/$1");
        $route->put("(:num)", "ProductController::update/$1");
        $route->put("(:num)/status", "ProductController::status/$1");
        $route->put("(:num)/featured", "ProductController::featured/$1");
        $route->put("(:num)/new_label", "ProductController::new_label/$1");
        // inventories
        $route->get("inventories", "ProductInventoriesController::index");
        $route->post("inventories/stockChange", "ProductInventoriesController::stockChange");
        /* product IMAGES ROUTES */
        $route->get("images", "ProductImagesController::index");
        $route->delete("images/(:num)", "ProductImagesController::remove/$1");
        $route->post("images/(:num)", "ProductImagesController::store/$1");
        $route->get("images/edit", "ProductImagesController::edit");
        $route->put("images/(:num)", "ProductImagesController::update/$1");
        $route->post("images/(:num)/primary", "ProductImagesController::is_primary/$1");
        /* product comments ROUTES */
        $route->get("comments", "ProductComments::index");
        $route->get("reviews", "ProductReviews::index");
        /* TAGS ROUTES */
        $route->get("tags", "ProductTags::index");
        $route->delete("tags/(:num)", "ProductTags::remove/$1");
        $route->get("tags/edit", "ProductTags::edit");
        $route->post("tags/(:num)", "ProductTags::store/$1");
        $route->put("tags/(:num)", "ProductTags::update/$1");
        /* PRODUCT META ROUTES */
        $route->get("meta", "ProductMeta::index");
        $route->delete("meta/(:num)", "ProductMeta::remove/$1");
        $route->get("meta/edit", "ProductMeta::edit");
        $route->post("meta/(:num)", "ProductMeta::store/$1");
        $route->put("meta/(:num)", "ProductMeta::update/$1");
        /* PRODUCT DISCOUNT */
        $route->get("discount", "ProductDiscountController::index");
        $route->delete("discount/(:num)", "ProductDiscountController::remove/$1");
        $route->get("discount/edit", "ProductDiscountController::edit");
        $route->post("discount/(:num)", "ProductDiscountController::store/$1");
        $route->put("discount/(:num)", "ProductDiscountController::update/$1");
    });
    /* brands routes */
    $route->group("brands", function ($brandRoute) {
        $brandRoute->get("/", "BrandController::index");
        $brandRoute->post("/", "BrandController::store");
        $brandRoute->delete("(:num)", "BrandController::remove/$1");
        $brandRoute->put("/", "BrandController::update");
        $brandRoute->get("get", "BrandController::get_update_brand");
    });
    /* categoris routes */
    $route->group("categories", function ($categories_route) {
        $categories_route->get("/", "CategoryController::index");
        $categories_route->delete("(:num)", "CategoryController::remove/$1");
        $categories_route->post("/", "CategoryController::store");
        $categories_route->put("/", "CategoryController::update");
        $categories_route->get("get", "CategoryController::get_update_category");
    });
    /* tags routes */
    $route->group("tags", function ($tags_route) {
        $tags_route->get("/", "TagsController::index");
        $tags_route->delete("(:num)", "TagsController::remove/$1");
        $tags_route->post("/", "TagsController::store");
        $tags_route->put("/", "TagsController::update");
        $tags_route->get("get", "TagsController::get_update_tags");
    });
    /* slider routes */
    $route->group("slider", function ($slider_route) {
        $slider_route->get("/", "SliderController::index");
        $slider_route->delete("(:num)", "SliderController::remove/$1");
        $slider_route->post("/", "SliderController::store");
        $slider_route->put("/", "SliderController::update");
        $slider_route->get("edit", "SliderController::edit");
    });
    /* banner routes */
    $route->group("banner", function ($banner_route) {
        $banner_route->get("/", "BannerController::index");
        $banner_route->delete("(:num)", "BannerController::remove/$1");
        $banner_route->post("/", "BannerController::store");
        $banner_route->put("/", "BannerController::update");
        $banner_route->get("edit", "BannerController::edit");
    });
    /* offer routes */
    $route->group("offer", function ($offer_route) {
        $offer_route->get("/", "OfferController::index");
        $offer_route->delete("(:num)", "OfferController::remove/$1");
        $offer_route->post("/", "OfferController::store");
        $offer_route->put("/", "OfferController::update");
        $offer_route->get("edit", "OfferController::get_update_offer");
    });
    /* order routes */
    $route->group("order", function ($order_route) {
        $order_route->get("/", "OrderController::index");
        $order_route->post("accept/(:num)", "OrderController::accept/$1");
        $order_route->get("view/(:segment)", "OrderController::view_detail/$1");
        $order_route->post("tracking/(:num)", "OrderController::tracking_add/$1");
        $order_route->post("pdf/(:num)", "OrderController::generate_pdf/$1");
        $order_route->post("reject/(:num)", "OrderController::reject/$1");
        $order_route->get("waiting", "OrderController::waiting");
        $order_route->get("process", "OrderController::process");
        $order_route->get("shipped", "OrderController::shipped");
        $order_route->get("done", "OrderController::done");
        $order_route->get("reject", "OrderController::reject_view");
    });
    /* Errors Routes */
    $route->group("error", function ($error) {
        $error->get("403", "ErrorsController::error_forbidden");
    });
    /* WEBSITE ROUTES */
    $route->group("website", function ($website) {
        $website->get("/", "WebsiteController::index");
        $website->post("change", "WebsiteController::change");
    });
    /* reports */
    $route->group("report", function ($report) {
        $report->get("/", "ReportController::product_sales_report");
        $report->get("visitor", "ReportController::visitor_perweek");
        $report->get("user_regis", "ReportController::user_registration");
        $report->post("generate/sales/pdf", "ReportController::generete_pdf_report_sales");
        $report->post("generate/visitor/pdf", "ReportController::generete_pdf_report_visitor");
        $report->post("generate/user/pdf", "ReportController::generete_pdf_report_user");
        $report->post("generate/product_sales/pdf", "ReportController::generete_pdf_report_product_sales");
        $report->get("product_sales", "ReportController::product_report");
    });

    /* ADD NEW ADMIN ROUTES */
    $route->group("list/admin", ['filter' => ['admin-auth', 'dev']], function ($admin) {
        $admin->get("/", "Admin\AdminController::index");
        $admin->post("/", "Admin\AdminController::create");
        $admin->delete("(:num)", "Admin\AdminController::remove/$1");
        $admin->get("get", "Admin\AdminController::get_update_admin");
        $admin->put("/", "Admin\AdminController::update");
        $admin->post("roles/add/(:num)", "Admin\AdminController::add_roles/$1");
        $admin->delete("roles/remove/(:num)", "Admin\AdminController::remove_roles/$1");
    });
    $route->group("mail", ['filter' => ['admin-auth', 'dev']], function ($mail) {
        $mail->get("/", "Admin\MailController::index");
        $mail->post("/", "Admin\MailController::add");
    });
    $route->get("mail/send/promo", "MailController::promo");
    $route->get("mail/send/testing", "MailController::testing");
    $route->post("mail/send/testing", "MailController::run_test");
    $route->group("mail/template", function ($template) {
        $template->get('/', "EmailTempalteController::index");
        $template->get('get', "EmailTempalteController::get_update_template");
        $template->post('/', "EmailTempalteController::store");
        $template->put('/', "EmailTempalteController::update");
        $template->delete('(:num)', "EmailTempalteController::remove/$1");
    });
});
$routes->post("/" . ADMIN_PATH . "/auth/logout", "Admin\AuthController::logout", ['filter' => "admin-auth"]);
$routes->group("/" . ADMIN_PATH . "/auth", ["namespace" => $routes->getDefaultNamespace() . "Admin", "filter" => "admin-guest"], function ($route) {
    $route->get("login", "AuthController::index");
    $route->post("login", "AuthController::login");
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
