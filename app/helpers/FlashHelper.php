<?php
class FlashHelper {
    public static function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    public static function display() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            
            echo '<div class="alert alert-' . htmlspecialchars($flash['type']) . ' alert-dismissible fade show">';
            echo htmlspecialchars($flash['message']);
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
        }
    }
}