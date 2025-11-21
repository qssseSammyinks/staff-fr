<?php
require_once 'config.php';

function isAdmin() {
    return isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] ===
tue;
}

function login($user, $pass) {
    if ($user === $_ENV['ADMIN_USER'] && $pass === $_ENV['ADMIN_PASS']) {
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
}