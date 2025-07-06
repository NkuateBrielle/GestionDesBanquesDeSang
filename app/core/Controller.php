<?php
namespace App\core;
class Controller {
    protected function view($view, $data = []) {
        extract($data);
        
        // Chemin vers la vue
        $viewFile = __DIR__ . '/../../app/views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require_once __DIR__ . '/../../app/views/layouts/header.php';
            require_once $viewFile;
            require_once __DIR__ . '/../../app/views/layouts/footer.php';
        } else {
            die("View does not exist");
        }
    }

    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
}