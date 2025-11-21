<?php
require_once 'config.php';

function login($user, $pass) {
    if ($user === $_ENV['ADMIN_USER'] && $pass === $_ENV['ADMIN_PASS']) {
        $_SESSION['admin_logged'] = true;
        return true;
    }
    return false;
}

function logout(){
    session_unset();
    session_destroy();
}

function requireAdmin() {
    if (empty($_SESSION['admin_logged'])) {
        header('Location: login.php');
        exit;
    }
}