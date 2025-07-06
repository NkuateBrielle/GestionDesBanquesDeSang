<?php
namespace App\core;
class App {
    public $router;

    public function __construct() {
        $this->router = new Router();
    }
    public function getConfig($key) {
        $config = [
            'DB_HOST' => 'localhost',
            'DB_USER' => 'root',
            'DB_PASS' => '',
            'DB_NAME' => 'blood_donation',
            'APP_ROOT' => dirname(dirname(__FILE__)),
            'URL_ROOT' => 'http://localhost/GestionDesBanquesDeSang/',
            'SITE_NAME' => 'SangPourTous',
        ];
        return $config[$key] ?? null;
    }
    public function getDatabaseConnection() {
        $host = $this->getConfig('DB_HOST');
        $user = $this->getConfig('DB_USER');
        $pass = $this->getConfig('DB_PASS');
        $name = $this->getConfig('DB_NAME');

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public function run() {
        // Initialize the router and dispatch the request
        $this->router->dispatch();
    }
    public function getRouter() {
        return $this->router;
    }
    public function setRouter($router) {
        $this->router = $router;
    }
    public function getBaseUrl() {
        return $this->getConfig('URL_ROOT');
    }
    public function getSiteName() {
        return $this->getConfig('SITE_NAME');
    }
}