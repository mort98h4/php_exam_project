<?php

define('_STR_MIN_LEN', 2);
define('_STR_MAX_LEN', 30);
define('_IMG_TARGET_DIR', 'public/images/uploads/');
define('_IMG_FORMATS', ['image/png', 'image/jpeg', 'image/jpg']);

include_once __DIR__ . '/classes/DBConnection.php';

function _respond($message='', int $status=200) {
    http_response_code($status);
    header('Content-Type: application/json');
    $res = is_array($message) ? $message : ['info' => $message];
    echo json_encode($res);
    exit();
}

function _redirect(string $url='/') {
    header("Location: $url");
    exit();
}

function _validateSession(array $session) {
    if ($session === []) return false;
    if (
        !isset($session['user_id']) || 
        !isset($session['user_first_name']) ||
        !isset($session['user_last_name']) ||
        !isset($session['user_email']) ||
        !isset($session['user_role']) ||
        !isset($session['session_id'])
    ) {
        session_destroy();
        return false;  
    } 

    try {
        $db = new DB;
        $db = $db->connect();

        $query = $db->prepare('SELECT * FROM sessions WHERE session_id = :session_id AND session_user_id = :user_id LIMIT 1');
        $query->bindValue(':session_id', $session['session_id']);
        $query->bindValue(':user_id', $session['user_id']);
        $query->execute();

        $count = $query->rowCount();
        if ($count === 0) {
            session_destroy();
            return false;
        } else {
            return true;
        }
    } catch (Exception $ex) {
        session_destroy();
        _respond('Server error.', 500);
    }
}

function _validateImage($image) {
    if (!isset($image)) {
        _respond('Please provide an image.', 400);
    } 
    if ($image['error'] === UPLOAD_ERR_INI_SIZE) {
        _respond('Image too large', 400);
    }

    $imgTmpName = $image['tmp_name'];
    $targetFile = _IMG_TARGET_DIR . basename($image['name']);
    $imgFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $imgMime = mime_content_type($imgTmpName);

    if (!in_array($imgMime, _IMG_FORMATS)) {
        _respond('File format not allowed.', 400);
    }

    $rndImgName = bin2hex(random_bytes(16));
    switch($imgMime) {
        case 'image/png':
            $rndImgName .= '.png';
            break;
        case 'image/jpeg':
            $rndImgName .= '.jpeg';
            break;
        case 'image/jpg':
            $rndImgName .= '.jpg';
            break;
    }

    if (!move_uploaded_file($imgTmpName, _IMG_TARGET_DIR . $rndImgName)) {
        _respond('Server error.', 500);
    }

    return $rndImgName;
}

function _deleteImage(string $image): bool {
    return unlink(_IMG_TARGET_DIR . $image);
}

function _getTapwall(): array {
    try{
        $db = new DB;
        $db = $db->connect();
    
        $query = $db->prepare('SELECT * FROM beers_and_breweries WHERE beer_is_active = 1 ORDER BY beer_tapwall_no ASC LIMIT 29');
        $query->execute();
    
        $beers = $query->fetchAll();
        return $beers;
    } catch (Exception $ex) {
        _respond('Server error.', 500);
    }
}

function _getBreweries(): array {
    try {
        $db = new DB;
        $db = $db->connect();

        $query = $db->prepare('SELECT * FROM breweries ORDER BY brewery_name LIMIT 10 OFFSET 0');
        $query->execute();

        $breweries = $query->fetchAll();
        return $breweries;
    } catch (Exception $ex) {
        _respond('Server error.', 500);
    }
}

function _getBeers(): array {
    try {
        $db = new DB;
        $db = $db->connect();

        $query = $db->prepare('SELECT * FROM beers_and_breweries ORDER BY beer_created_at DESC LIMIT 5 OFFSET 0');
        $query->execute();

        $beers = $query->fetchAll();
        return $beers;
    } catch (Exception $ex) {
        _respond('Server error.', 500);
    }
}

function _getUsers(): array {
    try {
        $db = new DB;
        $db = $db->connect();

        $query = $db->prepare('SELECT * FROM users_and_roles LIMIT 10');
        $query->execute();

        $users = $query->fetchAll();
        return $users;
    } catch (Exception $ex) {
        _respond('Server error.', 500);
    }
}

function _getRoles(): array {
    try {
        $db = new DB;
        $db = $db->connect();

        $query = $db->prepare('SELECT * FROM roles LIMIT 3');
        $query->execute();

        $roles = $query->fetchAll();
        return $roles;
    } catch (Exception $ex) {
        _respond('Server error.', 500);
    }
}