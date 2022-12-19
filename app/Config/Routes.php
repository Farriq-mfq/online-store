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
});
$routes->group("auth", ["filter" => "user-guest"], function ($route) {
    $route->get('login', 'AuthController::index');
    $route->post('login', 'AuthController::login');
    // $route->get('(:segment)', 'ProductController::detail/$1');
});

$routes->group("api",function($route){
    $route->get("data/city","ShippingController::cityByprovice");
    $route->get("data/province","ShippingController::getProvince");
});

$routes->get("/", "Home::index");


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
        $route->post("inventories/(:num)", "ProductInventoriesController::store/$1");
        $route->get("inventories/edit", "ProductInventoriesController::edit");
        $route->put("inventories/(:num)", "ProductInventoriesController::update/$1");
        $route->delete("inventories/(:num)", "ProductInventoriesController::remove/$1");
        /* product inventories ROUTES */
        $route->get("images", "ProductImagesController::index");
        $route->delete("images/(:num)", "ProductImagesController::remove/$1");
        $route->post("images/(:num)", "ProductImagesController::store/$1");
        $route->get("images/edit", "ProductImagesController::edit");
        $route->put("images/(:num)", "ProductImagesController::update/$1");
        $route->post("images/(:num)/primary", "ProductImagesController::is_primary/$1");
        /* product comments ROUTES */
        $route->get("comments", "ProductComments::index");
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
