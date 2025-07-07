<?php
class AuthController extends Controller {
    public function login() {
        View::render('auth/login', ['title' => 'Connexion']);
    }

    public function attemptLogin() {
        // Traitement de la connexion
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (AuthHelper::attemptLogin($email, $password)) {
            if(AuthHelper::checkRole('admin')) {
                FlashHelper::setFlash('success', 'Bienvenue, administrateur !');
                header('Location: ' . View::url('admin/dashboard'));
            } elseif(AuthHelper::checkRole('donor')) {
                FlashHelper::setFlash('success', 'Bienvenue, donneur !');
                header('Location: ' . View::url('donor/dashboard'));
            } elseif(AuthHelper::checkRole('hospital')) {
                FlashHelper::setFlash('success', 'Bienvenue, hôpital !');
                header('Location: ' . View::url('hospital/dashboard'));
            } else {
                FlashHelper::setFlash('error', 'Rôle inconnu');
                header('Location: ' . View::url('login'));
            }
            exit;
        } else {
            FlashHelper::setFlash('error', 'Email ou mot de passe incorrect');
            header('Location: ' . View::url('login'));
            exit;
        }
    }

    public function registerDonor() {
        View::render('auth/register', [
            'title' => 'Inscription Donneur',
            'userType' => 'donor'
        ]);
    }

    public function storeDonor() {
        // Traitement de l'inscription donneur
        $data = [
            'first_name' => $_POST['first_name'] ?? '',
            'last_name' => $_POST['last_name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? '',
            'blood_type' => $_POST['blood_type'] ?? ''
        ];
        if (AuthHelper::registerDonor($data)) {
            FlashHelper::setFlash('success', 'Inscription réussie. Vous pouvez maintenant vous connecter.');

            header('Location: ' . View::url('login'));
            exit;
        } else {
            FlashHelper::setFlash('error', 'Erreur lors de l\'inscription. Veuillez réessayer.');
            header('Location: ' . View::url('register/donor'));
            exit;
        }
    }

    public function logout(){
        FlashHelper::setFlash('success', 'Vous ete deconnecter.');

        header('Location: ' . View::url('login'));
    }

    // ... autres méthodes
}