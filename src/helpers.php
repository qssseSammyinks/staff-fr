<?php
function sanitize($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function uploadFile($file) {
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . "." . $ext;
    $path = UPLOAD_DIR . $filename;
    if (move_uploaded_file($file['tmp_name'], $path)) {
        return $filename;
    }
    return null;
}