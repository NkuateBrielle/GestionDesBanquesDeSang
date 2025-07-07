<?php
// Configuration de l'application
define('APP_NAME', 'Blood Bank');
define('APP_URL', 'http://localhost/GestionDesBanquesDeSang');
define('APP_ROOT', dirname(dirname(__FILE__)));

// Configuration de session
define('SESSION_LIFETIME', 3600); // 1 heure
define('SESSION_NAME', 'blood_bank_session');

// Chargement des variables d'environnement (simplifié sans phpdotenv)
if (file_exists(APP_ROOT . '/.env')) {
    $env = parse_ini_file(APP_ROOT . '/.env');
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}

// Configuration de sécurité
define('CSRF_TOKEN_NAME', 'csrf_token');
define('PASSWORD_ALGO', PASSWORD_BCRYPT);
define('PASSWORD_OPTIONS', ['cost' => 12]);

// Configuration des uploads
define('UPLOAD_DIR', APP_ROOT . '/public/uploads/');
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024); // 2MB
define('ALLOWED_FILE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('VIEW_PATH', APP_ROOT . '/views');