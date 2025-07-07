<?php
class View {
    public static function render($view, $data = []) {
        // Extraire les données pour les rendre accessibles dans la vue
        extract($data);
        
        // Chemin vers le fichier de vue
        $viewFile = VIEW_PATH . '/' . $view . '.php';
        
        // Vérifier si le fichier existe
        if (!file_exists($viewFile)) {
            throw new Exception("La vue '$view' n'existe pas dans le dossier views/");
        }
        
        // Inclure le layout principal
        require_once VIEW_PATH . '/layouts/main.php';
    }
    
    public static function renderPartial($view, $data = []) {
        extract($data);
        $viewFile = VIEW_PATH . '/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            throw new Exception("Partial view '$view' not found");
        }
    }
    
    public static function asset($path) {
        return APP_URL . '/public/assets/' . ltrim($path, '/');
    }
    
    public static function url($path = '') {
        return APP_URL . '/' . ltrim($path, '/');
    }
}