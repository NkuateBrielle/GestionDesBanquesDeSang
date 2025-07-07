<?php
class ValidationHelper {
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public static function validatePassword($password) {
        return strlen($password) >= 8;
    }
    
    public static function validatePhone($phone) {
        return preg_match('/^[0-9]{10,15}$/', $phone);
    }
    
    public static function validateBloodType($type) {
        $validTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        return in_array($type, $validTypes);
    }
    
    public static function sanitizeInput($input) {
        return htmlspecialchars(trim($input));
    }
    
    public static function validateCSRF($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    public static function generateCSRF() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}