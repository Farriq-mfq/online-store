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
$routes->group("product", function ($route) {
    $route->get('/', 'ProductController::index');
    $route->get('(:segment)', 'ProductController::detail/$1');
});
$routes->group("cart", ["filter" => "user"], function ($route) {
    $route->get("/", "CartController::index");
    $route->post("add", "ProductController::add_to_cart");
    $route->get("get", "ProductController::getCountCart");
    $route->post("update", "CartController::update_cart");
    $route->post("delete/all", "CartController::remove_cart_all");
    $route->post("checkout","CartController::checkout");
    $route->get("checkout","CartController::checkout_page");
    $route->post("process_to_checkout","OrderController::checkout");
    $route->get("get_user_address","CartController::get_user_address");
});
$routes->group("auth", ["filter" => "user-guest"], function ($route) {
    $route->get('login', 'AuthController::index');
    $route->post('login', 'AuthController::login');
    // $route->get('(:segment)', 'ProductController::detail/$1');
});

$routes->group("api/shipping",function($route){
    $route->get("city","ShippingController::cityByprovice");
    $route->get("province","ShippingController::getProvince");
    $route->get("cost","ShippingController::getCost");
});

$routes->get("/", "Home::index");

$routes->group("api/data",function($route){
    $route->get("product","ApiController::get_product");
});


/* ADMIN ROUTES */
$routes->group("/" . ADMIN_PATH, ["namespace" => $routes->getDefaultNamespace() . "Admin", "filter" => ["admin-auth", "roles-auth"]], function ($route) {
    $route->get("/", "HomeController::index");
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
    $route->group("tags", function ($categories_route) {
        $categories_route->get("/", "TagsController::index");
        $categories_route->delete("(:num)", "TagsController::remove/$1");
        $categories_route->post("/", "TagsController::store");
        $categories_route->put("/", "TagsController::update");
        $categories_route->get("get", "TagsController::get_update_tags");
    });
    /* slider routes */
    $route->group("slider", function ($categories_route) {
        $categories_route->get("/", "SliderController::index");
        $categories_route->delete("(:num)", "SliderController::remove/$1");
        $categories_route->post("/", "SliderController::store");
        $categories_route->put("/", "SliderController::update");
        $categories_route->get("edit", "SliderController::edit");
    });
    /* banner routes */
    $route->group("banner", function ($categories_route) {
        $categories_route->get("/", "BannerController::index");
        $categories_route->delete("(:num)", "BannerController::remove/$1");
        $categories_route->post("/", "BannerController::store");
        $categories_route->put("/", "BannerController::update");
        $categories_route->get("edit", "BannerController::edit");
    });
    /* offer routes */
    $route->group("offer", function ($categories_route) {
        $categories_route->get("/", "OfferController::index");
        $categories_route->delete("(:num)", "OfferController::remove/$1");
        $categories_route->post("/", "OfferController::store");
        $categories_route->put("/", "OfferController::update");
        $categories_route->get("edit", "OfferController::get_update_offer");
    });
    /* Errors Routes */
    $route->group("error", function ($categories_route) {
        $categories_route->get("403", "ErrorsController::error_forbidden");
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
