<?php
class HomeController extends Controller {
    public function index() {
        View::render('home/index', [
            'title' => 'Accueil - ' . APP_NAME
        ]);
    }
    
    public function about() {
        View::render('home/about', [
            'title' => 'À propos - ' . APP_NAME
        ]);
    }
    
    public function contact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement du formulaire de contact
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';
            
            // Validation et envoi...
            
            FlashHelper::setFlash('success', 'Votre message a été envoyé avec succès');
            header('Location: ' . APP_URL . '/contact');
            exit;
        }
        
        View::render('home/contact', [
            'title' => 'Contact - ' . APP_NAME
        ]);
    }
}