<?php
session_start();
require_once __DIR__.'/../config.php';
// require_once __DIR__.'/../app/core/Router.php';
// require_once __DIR__.'/../app/core/App.php';

// Autoloader simple pour les classes
spl_autoload_register(function ($class) {
    $class = str_replace('App\\', '', $class); // on retire le préfixe App\
    $file = __DIR__.'/../app/'.str_replace('\\', '/', $class).'.php';
    if (file_exists($file)) {
        require $file;
    }
});


// Initialiser l'application
// $app = App\core\App::getInstance();

// Routes
$router = App\core\Router::getInstance();


// // Routes publiques
$router->get('/', 'PublicController@index');
$router->get('/search', 'PublicController@search');
$router->get('/contact-donor/{id}', 'PublicController@contactDonor');

// Routes donneurs
$router->get('/donor/register', 'AuthController@donorRegister');
$router->post('/donor/register', 'AuthController@donorRegister');
$router->get('/donor/login', 'AuthController@donorLogin');
$router->post('/donor/login', 'AuthController@donorLogin');
$router->get('/donor/dashboard', 'DonorController@dashboard');
$router->get('/donor/profile', 'DonorController@profile');
$router->post('/donor/profile', 'DonorController@updateProfile');

// Routes hôpitaux
$router->get('/hospital/register', 'AuthController@hospitalRegister');
$router->post('/hospital/register', 'AuthController@hospitalRegister');
$router->get('/hospital/login', 'AuthController@hospitalLogin');
$router->post('/hospital/login', 'AuthController@hospitalLogin');
$router->get('/hospital/dashboard', 'HospitalController@dashboard');
$router->post('/hospital/update-stock', 'HospitalController@updateStock');

// Démarrer le routeur
$router->dispatch();