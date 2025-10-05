<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::getArticles');
$routes->get('article/(:num)', 'Main::show/$1');

$routes->get('admin', 'Administration::loadAdministration');
$routes->get('admin/articles', 'Administration::articles');
$routes->get('admin/article/new', 'Administration::articleForm');
$routes->get('admin/article/(:num)', 'Administration::articleForm/$1');
$routes->post('admin/article/save', 'Administration::saveArticle');
$routes->get('admin/article/delete/(:num)', 'Administration::deleteArticle/$1');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::loginPost');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::registerPost');
$routes->get('logout', 'AuthController::logout');

$routes->get('seasons/(:num)/matches', 'SeasonController::matches/$1');
$routes->get('seasons', 'SeasonController::index');
$routes->get('seasons/show/(:num)', 'SeasonController::show/$1');
$routes->get('match/(:num)', 'SeasonController::matchDetail/$1');
$routes->get('teams', 'Teams::index');