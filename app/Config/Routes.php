<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.



/**
 * slug placeholder:
 *
 *  [a-z0-9]+     # One or more repetition of given characters
 *  (?:           # A non-capture group.
 *    -           # A hyphen
 *    [A-Z0-9]+   # One or more repetition of given characters
 *  )*            # Zero or more repetition of previous group
 *
 *  This will match:
 *  - A sequence of alphanumeric characters at the beginning.
 *  - Then it will match a hyphen, then a sequence of alphanumeric characters, 0 or more times.
 *
 * Examples :
 *   item12345
 *   some-blog-article
 *
 */

 /**
  *     (:any)	will match all characters from that point to the end of the URI. This may include multiple URI segments.
  *     (:segment)	will match any character except for a forward slash (/) restricting the result to a single segment.
  *     (:num)	will match any integer.
  *     (:alpha)	will match any string of alphabetic characters
  *     (:alphanum)	will match any string of alphabetic characters or integers, or any combination of the two.
  *     (:hash)	is the same as (:segment), but can be used to easily see which routes use hashed ids.
  */
  $routes->addPlaceholder('slug', '[a-zA-Z0-9_]+(?:-[a-zA-Z0-9]+)*');

  $routes->group('', ['namespace' => 'App\Controllers\Web'],function ($routes) {
    $routes->get('/', 'Home::index');

    
    $routes->get("signup", "AuthenticationController::signup");
    $routes->get("login", "AuthenticationController::login");
    $routes->get("logout", "AuthenticationController::logout");
    $routes->get("authentication/activationemail/(:segment)/(:segment)", "AuthenticationController::activateConfirmUser/$1/$2");
    $routes->get("authentication/resetpasswordemail/(:segment)/(:segment)", "AuthenticationController::resetPasswordConfirmUser/$1/$2");
    $routes->post("signup", "AuthenticationController::signup_");
    $routes->post("login", "AuthenticationController::login_");
    $routes->post("deliveryaddress", 'BizController::deliveryAddress_');
    $routes->post("deliverylocation", 'BizController::deliveryLocation_');
    $routes->get("deliverylocation", 'BizController::getDeliveryLocation');

    
    $routes->get("emailtest", "AuthenticationController::emailTest");

    // get all vendor
    $routes->get(VENDOR_REST, 'BizController::index/'.VENDOR_REST);
    $routes->get(VENDOR_GROC, 'BizController::index/'.VENDOR_GROC);
    $routes->get(VENDOR_PART, 'BizController::index/'.VENDOR_PART);

    //get details of vendor by slug
    $routes->get(VENDOR_REST.'/(:segment)', 'BizController::bizCategoryMenu/$1');
    $routes->get(VENDOR_GROC.'/(:segment)', 'BizController::bizCategoryMenu/$1');
    $routes->get(VENDOR_PART.'/(:segment)', 'BizController::bizCategoryMenu/$1');

    // get vendor Checkout
    $routes->get(VENDOR_REST.'/(:segment)/checkout', 'BizController::checkOut/$1');
    $routes->get(VENDOR_GROC.'/(:segment)/checkout', 'BizController::checkOut/$1');
    $routes->get(VENDOR_PART.'/(:segment)/checkout', 'BizController::checkOut/$1');
    
    // get vendor menu
    $routes->get(VENDOR_REST.'/(:segment)/(:segment)', 'BizController::menu/$1/$2');
    $routes->get(VENDOR_GROC.'/(:segment)/(:segment)', 'BizController::groceryMenu/$1/$2');
    $routes->get(VENDOR_PART.'/(:segment)/(:segment)', 'BizController::partyMenu/$1/$2');

    

    // Add to Cart
    $routes->post('addtocart', 'BizController::addToCart');
    // Remove from Cart
    $routes->get('removecart/(:segment)', 'BizController::removeCart/$1');
    
  });

  $routes->group('user', ['namespace' => 'App\Controllers\Web','filter' => 'authGuard'], function ($routes) {

    $routes->get('profile', 'UsersController::index');
    $routes->get('order', 'UsersController::order');
    $routes->get('order/(:segment)', 'UsersController::orderDetails/$1');

    $routes->get('verifypayment', 'UsersController::verifyPayment');
    $routes->post('makepayment', 'UsersController::makePayment', ['as' => 'user_payment']);
    
    $routes->post('add/address', 'UsersController::address_');

  });

  $routes->group('otfadmin', ['namespace' => 'App\Controllers\Web\Superadmin'], function ($routes) {
    
    $routes->get("", "AuthenticationController::login");
    $routes->get("login", "AuthenticationController::login");
    $routes->post("login", "AuthenticationController::login_");
    $routes->get("logout", "AuthenticationController::logout");

  });

  $routes->group('otfadmin', ['namespace' => 'App\Controllers\Web\Superadmin','filter' => 'authAdminGuard'], function ($routes) {
    
    $routes->get('dashboard', 'DashboardController::index');

    // view All Vendor
    $routes->get('vendor', 'BizController::index');
    $routes->get('vendor/(:segment)', 'BizController::overview/$1', ['as' => 'vendor']);

    
    $routes->post('add/vendor', 'BizController::add');
    $routes->post('edit/vendor/(:segment)', 'BizController::edit/$1', ['as' => 'vendor_edit']);
    $routes->post('editlogo/vendor/(:segment)', 'BizController::editLogo/$1', ['as' => 'vendor_editLogo']);

    $routes->get('checkbizname', 'AuthenticationController::checkbizname');

    

    $routes->get('vendor/(:segment)/menus', 'MenuController::index/$1', ['as' => 'menus']);
    $routes->get('vendor/(:segment)/menus/(:segment)', 'MenuController::details/$1/$2', ['as' => 'menu_details']);
    $routes->get('vendor/(:segment)/add-menu', 'MenuController::add/$1', ['as' => 'menu_add']);
    $routes->get('vendor/(:segment)/edit-menu/(:segment)', 'MenuController::edit/$1/$2', ['as' => 'menu_edit']);

    $routes->get('menu/(:segment)/checkmenuname', 'MenuController::checkMenuName/$1');

    $routes->post('add/menu/(:segment)', 'MenuController::add_/$1', ['as' => 'menu_new']);
    $routes->put('edit/menu/(:segment)', 'MenuController::edit_/$1', ['as' => 'menu_update']);


    $routes->get('vendor/(:segment)/menu-categories', 'MenuController::menuCategory/$1', ['as' => 'menucategory']);
    $routes->get('vendor/(:segment)/add-menu-category', 'MenuController::menuCategoryAdd/$1', ['as' => 'menucategory_add']);
    $routes->get('vendor/(:segment)/edit-menu-category/(:segment)', 'MenuController::menuCategoryEdit/$1/$2', ['as' => 'menucategory_edit']);

    $routes->get('menu/checkmenuctgyname', 'MenuController::checkMenuCategoryName');

    $routes->post('add/menu-category/(:segment)', 'MenuController::menuCategoryAdd_/$1', ['as' => 'menucategory_new']);
    $routes->post('add/menu-category-child/(:segment)/(:segment)', 'MenuController::menuCategoryAdd_/$1/$2');
    $routes->post('edit/menu-category/(:segment)', 'MenuController::menuCategoryEdit_/$1', ['as' => 'menucategory_update']);
    $routes->delete('delete/menu-category/(:segment)', 'MenuController::menuCategoryDelete/$1', ['as' => 'menucategory_delete']);


    // Generate the relative URL to link to user ID 15, gallery 12
    // Generates: /vendor/the_place/menus/jollof_rice
    // <a href= route_to('vendor_menus_details', 15, 12) >View Menu</a>

    // view All Customer
    $routes->get('customer', 'CustomersController::index');
    $routes->get('customer/(:segment)', 'CustomersController::overview/$1', ['as' => 'customer']);

    $routes->post('add/address/(:segment)', 'CustomersController::address_/$1');
    $routes->post('edit/address/(:segment)', 'CustomersController::addressEdit/$1', ['as' => 'address_edit']);
    $routes->delete('delete/address/(:segment)', 'CustomersController::addressDelete/$1', ['as' => 'address_delete']);


    // view All Order
    $routes->get('orders', 'OrdersController::index',['as' => 'orders']);



  });

$routes->group('api', ['namespace' => 'App\Controllers\Api'],function ($routes) {
    $routes->post("signup", "AuthenticationController::signup");
    $routes->post("authentication", "AuthenticationController::login");
    $routes->get("users", "UserController::index"/*, ['filter' => 'authTokenFilter']*/);

    # Biz Routes
    $routes->get('biz', 'BizController::index');
    $routes->get('biz/(:segment)', 'BizController::show/$1');
    $routes->get('biz/(:segment)/(:segment)', 'BizController::menu/$1/$2');
    //$routes->get('biz/(:segment)', 'BizController::bizBySlug/$1');

    $routes->get('vendor', 'BizController::bizSuperAdminDataTable');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}