<?php
// Chargement de la configuration
require_once 'app/config/config.php';

// Autoloader maison pour les classes
spl_autoload_register(function($className) {
    $paths = [
        'app/controllers/',
        'app/models/',
        'app/helpers/',
        'core/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Démarrer la session
SessionHelper::start();

// Initialiser l'application
$app = new App();
$app->run();