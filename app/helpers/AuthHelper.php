<?php
class AuthHelper {
    public static function attemptLogin($email, $password) {
        $userModel = new UserModel();
        $user = $userModel->findByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_email'] = $user['email'];
            
            // Mettre à jour la dernière connexion
            $userModel->updateLastLogin($user['id']);
            
            return true;
        }
        
        return false;
    }

    public static function registerDonor(array $data): bool
    {
        $userModel = new UserModel();

        // Vérifier si l'email existe déjà
        if ($userModel->findByEmail($data['email'])) {
            FlashHelper::setFlash('error', 'L\'email est déjà utilisé');
            return false;
        }

        // Créer le nouvel utilisateur
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $userId = $userModel->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $hashedPassword,
            'role' => 'donor',
            'blood_type' => $data['blood_type']
        ]);

        return $userId !== false;
    }
    public static function registerHospital(array $data): bool
    {
        $userModel = new UserModel();

        // Vérifier si l'email existe déjà
        if ($userModel->findByEmail($data['email'])) {
            FlashHelper::setFlash('error', 'L\'email est déjà utilisé');
            return false;
        }

        // Créer le nouvel utilisateur
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $userId = $userModel->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $hashedPassword,
            'role' => 'hospital'
        ]);

        return $userId !== false;
    }
    public static function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            FlashHelper::setFlash('error', 'Veuillez vous connecter pour accéder à cette page');
            header('Location: ' . APP_URL . '/login');
            exit;
        }
    }
    
    public static function checkRole($requiredRole) {
        self::checkAuth();
        
        if ($_SESSION['user_role'] !== $requiredRole) {
            FlashHelper::setFlash('error', 'Accès non autorisé');
            header('Location: ' . APP_URL . '/' . $_SESSION['user_role'] . '/dashboard');
            exit;
        }
    }
    
    public static function userId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    public static function userRole() {
        return $_SESSION['user_role'] ?? null;
    }
    
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    public static function logout() {
        session_unset();
        session_destroy();
    }
}