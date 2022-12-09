<?php

namespace Config;

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
$routes->get('/', 'Home::index');

$routes->group("/".ADMIN_PATH,["namespace"=>$routes->getDefaultNamespace()."Admin"],function($route){
    $route->get("/","Home::index");
    /* PRODUCT ROUTES */
    $route->group("product",function($route){
        $route->get("/","ProductController::index");
        // product add new
        $route->get("new","ProductController::create");
        $route->post("new","ProductController::add");
        // product delete
        $route->delete("(:num)","ProductController::remove/$1");
        $route->get("(:num)/edit","ProductController::edit/$1");
        $route->put("(:num)","ProductController::update/$1");
        $route->put("(:num)/status","ProductController::status/$1");
        $route->put("(:num)/featured","ProductController::featured/$1");
        $route->put("(:num)/new_label","ProductController::new_label/$1");
        // inventories
        $route->get("inventories","ProductInventoriesController::index");
        $route->post("inventories/(:num)","ProductInventoriesController::store/$1");
        $route->delete("inventories/(:num)","ProductInventoriesController::remove/$1");
        /* product inventories ROUTES */
        $route->get("images","ProductImages::index");
        /* product comments ROUTES */
        $route->get("comments","ProductComments::index");
    });
    /* brands routes */
    $route->group("brands",function($brandRoute){
        $brandRoute->get("/","BrandController::index");
        $brandRoute->post("/","BrandController::store");
        $brandRoute->delete("(:num)","BrandController::remove/$1");
        $brandRoute->put("/","BrandController::update");
        $brandRoute->get("get","BrandController::get_update_brand");
    });
    /* categoris routes */
    $route->group("categories",function($categories_route){
        $categories_route->get("/","CategoryController::index");
        $categories_route->delete("(:num)","CategoryController::remove/$1");
        $categories_route->post("/","CategoryController::store");
        $categories_route->put("/","CategoryController::update");
        $categories_route->get("get","CategoryController::get_update_category");
    });
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
