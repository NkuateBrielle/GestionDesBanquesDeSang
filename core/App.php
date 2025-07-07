<?php
class App {
    private $router;
    
    public function __construct() {
        // Charger la configuration de la base de données
        require_once 'app/config/database.php';
        
        // Initialiser le routeur
        $this->router = new Router();
        
        // Charger les routes
        $this->loadRoutes();
    }
    
    private function loadRoutes() {
        // Routes publiques
        $this->router->get('', 'HomeController@index');
        $this->router->get('about', 'HomeController@about');
        $this->router->get('contact', 'HomeController@contact');
        
        // Routes d'authentification
        $this->router->get('login', 'AuthController@login');
        $this->router->post('login', 'AuthController@attemptLogin');
        $this->router->get('register/donor', 'AuthController@registerDonor');
        $this->router->post('register/donor', 'AuthController@storeDonor');
        $this->router->get('register/hospital', 'AuthController@registerHospital');
        $this->router->post('register/hospital', 'AuthController@storeHospital');
        $this->router->get('logout', 'AuthController@logout');
        
        // Routes pour donneurs
        $this->router->get('donor/dashboard', 'DonorController@dashboard', ['auth', 'donor']);
        $this->router->get('donor/profile', 'DonorController@profile', ['auth', 'donor']);
        $this->router->post('donor/profile', 'DonorController@updateProfile', ['auth', 'donor']);
        $this->router->get('donor/availability', 'DonorController@availability', ['auth', 'donor']);
        $this->router->post('donor/availability', 'DonorController@updateAvailability', ['auth', 'donor']);
        
        // Routes pour hôpitaux
        $this->router->get('hospital/dashboard', 'HospitalController@dashboard', ['auth', 'hospital']);
        $this->router->get('hospital/profile', 'HospitalController@profile', ['auth', 'hospital']);
        $this->router->post('hospital/profile', 'HospitalController@updateProfile', ['auth', 'hospital']);
        $this->router->get('hospital/location', 'HospitalController@location', ['auth', 'hospital']);
        $this->router->post('hospital/location', 'HospitalController@updateLocation', ['auth', 'hospital']);
        $this->router->get('hospital/stocks', 'HospitalController@stocks', ['auth', 'hospital']);
        $this->router->post('hospital/stocks', 'HospitalController@updateStocks', ['auth', 'hospital']);
        
        // Routes pour patients (anonymes)
        $this->router->get('patient/search', 'PatientController@search');
        $this->router->post('patient/search', 'PatientController@findDonors');
        $this->router->get('patient/map', 'PatientController@map');
        $this->router->get('patient/results', 'PatientController@results');
        
        // Routes pour admin
        $this->router->get('admin/dashboard', 'AdminController@dashboard', ['auth', 'admin']);
        $this->router->get('admin/hospitals', 'AdminController@hospitals', ['auth', 'admin']);
        $this->router->get('admin/donors', 'AdminController@donors', ['auth', 'admin']);
        $this->router->get('admin/statistics', 'AdminController@statistics', ['auth', 'admin']);
    }
    
    public function run() {
        $this->router->dispatch();
    }
}