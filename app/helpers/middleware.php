<?php
if (!function_exists('adminOnly')) {
    function adminOnly() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
            $_SESSION['message'] = "Dostęp zabroniony";
            $_SESSION['type'] = "error";
            header('location: ' . BASE_URL . 'index.php');
            exit();
        }
    }
}

if (!function_exists('usersOnly')) {
    function usersOnly() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id'])) {
            $_SESSION['message'] = "Musisz się zalogować";
            $_SESSION['type'] = "error";
            header('location: ' . BASE_URL . 'login.php');
            exit();
        }
    }
}

if (!function_exists('guestsOnly')) {
    function guestsOnly() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['id'])) {
            header('location: ' . BASE_URL . 'dashboard.php');
            exit();
        }
    }
}
?>