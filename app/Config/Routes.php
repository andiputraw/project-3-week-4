<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group("auth", function () use ($routes) {
    $routes->get('login', 'AuthController::index');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
});

$routes->get('/',  'HomeController::index');

$routes->get('/hello', 'Hello::index');

$routes->group("mahasiswa", ['filter' => 'auth-admin'], static function () use ($routes) {
    $routes->get("", "MahasiswaController::index");
    $routes->get("create", "MahasiswaController::create");
    $routes->post("", "MahasiswaController::store");
    $routes->get("(:segment)", "MahasiswaController::show/$1");
    $routes->get("edit/(:segment)", "MahasiswaController::edit/$1");
    $routes->put("(:segment)", "MahasiswaController::update/$1");
    $routes->delete("(:segment)", "MahasiswaController::delete/$1");
});

$routes->group("courses", ['filter' => 'auth'], static function () use ($routes) {
    $routes->get("", "CourseController::index");
    $routes->group('', ['filter' => 'auth-admin'], static function () use ($routes) {
        $routes->post("", "CourseController::store");
        $routes->get("create", "CourseController::create");
        $routes->get("edit/(:segment)", "CourseController::edit/$1");
        $routes->put("(:segment)", "CourseController::update/$1");
        $routes->delete("(:segment)", "CourseController::delete/$1");
    });
    $routes->post("enroll/(:segment)", "CourseController::enroll/$1");
    $routes->get("(:segment)", "CourseController::show/$1");
});

