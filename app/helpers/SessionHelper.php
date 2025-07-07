<?php
class SessionHelper {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_name(SESSION_NAME);
            session_set_cookie_params([
                'lifetime' => SESSION_LIFETIME,
                'path' => '/',
                'domain' => $_SERVER['HTTP_HOST'] ?? '',
                'secure' => isset($_SERVER['HTTPS']),
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            session_start();
            
            // Régénération périodique de l'ID de session pour la sécurité
            if (!isset($_SESSION['last_regeneration'])) {
                self::regenerate();
            } else {
                $interval = 60 * 30; // 30 minutes
                if (time() - $_SESSION['last_regeneration'] > $interval) {
                    self::regenerate();
                }
            }
        }
    }
    
    public static function regenerate() {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
    
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }
    
    public static function delete($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    
    public static function destroy() {
        $_SESSION = [];
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        
        session_destroy();
    }
    
    public static function exists($key) {
        return isset($_SESSION[$key]);
    }
    
    public static function secureSession() {
        // Protection contre le fixation de session
        if (!isset($_SESSION['initiated'])) {
            self::regenerate();
            $_SESSION['initiated'] = true;
        }
        
        // Protection contre le hijacking
        if (isset($_SESSION['IPaddress']) || isset($_SESSION['userAgent'])) {
            if ($_SESSION['IPaddress'] !== $_SERVER['REMOTE_ADDR'] ||
                $_SESSION['userAgent'] !== $_SERVER['HTTP_USER_AGENT']) {
                self::destroy();
                self::start();
            }
        } else {
            $_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
        }
    }
    
    public static function csrfToken() {
        if (!self::exists('csrf_token')) {
            self::set('csrf_token', bin2hex(random_bytes(32)));
        }
        return self::get('csrf_token');
    }
    
    public static function verifyCsrfToken($token) {
        return hash_equals(self::get('csrf_token'), $token);
    }
}