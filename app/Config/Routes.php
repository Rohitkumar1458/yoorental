<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/contact', 'Home::contact');
$routes->match(['get','post'],'/contact/save', 'Home::contact_save');
$routes->get('/product/(:any)', 'Home::product_details/$1');
$routes->match(['get','post'], '/add_to_cart', 'Home::add_to_cart');
$routes->match(['get','post'], '/checkout', 'Home::checkout');
$routes->match(['get','post'], '/test', 'Home::test');

/**************************Fro Testing************************************** */
$routes->match(['get','post'], '/testpdf', 'Test::test_pdf');
$routes->match(['get','post'], '/exportexcel', 'Test::exportExcel');
$routes->match(['get','post'], '/create-order', 'Home::createOrder');
$routes->match(['get','post'], '/capture-order', 'Home::captureOrder');


/**************************************************************************** */

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->match(['get','post'],'/admin/dashboard', 'Admin\Dashboard::index');
    $routes->get('admin/logout', 'Admin\Auth::logout');

    /*************************************Users************************************* */
    $routes->get('admin/users', 'Admin\Users::index');
    $routes->match(['get','post'], 'admin/add_user', 'Admin\Users::add_user');
    $routes->match(['get','post'], 'admin/edit_user/(:num)', 'Admin\Users::edit_user/$1');
    $routes->match(['get','post'], 'admin/view_user/(:num)', 'Admin\Users::view_user/$1');
    $routes->match(['get','post'], 'admin/delete_user/(:num)', 'Admin\Users::delete_user/$1');

    /************************User Group**************************************** */
    $routes->get('admin/user-group', 'Admin\UserGroup::index');
    $routes->match(['get','post'], 'admin/add-group', 'Admin\UserGroup::add_group');


    /************************************Product*************************************** */
    $routes->get('admin/products', 'Admin\Product::index');
    $routes->match(['get','post'],'admin/product-cu', 'Admin\Product::add_edit_product');
    $routes->match(['get','post'],'admin/product-cu/(:num)', 'Admin\Product::add_edit_product/$1');
    
});

$routes->group('', ['filter' => 'AlreadyLoggedIn'], function ($routes) {
    $routes->match(['get','post'],'/admin', 'Admin\Auth::login');
});
