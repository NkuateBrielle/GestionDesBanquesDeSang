<?php
class Controller {
    protected function generateCSRFToken() {
        return ValidationHelper::generateCSRF();
    }
    
    protected function validateCSRFToken() {
        $token = $_POST['_csrf'] ?? '';
        if (!ValidationHelper::validateCSRF($token)) {
            die('Token CSRF invalide');
        }
    }
    
    protected function checkUploadedFile($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        
        if ($file['size'] > MAX_UPLOAD_SIZE) {
            return false;
        }
        
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        
        return in_array($mime, ALLOWED_FILE_TYPES);
    }
    
    protected function secureUpload($file, $destination) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('upload_', true) . '.' . $extension;
        $targetPath = UPLOAD_DIR . $destination . '/' . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $filename;
        }
        
        return false;
    }
}