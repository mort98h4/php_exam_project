<?php

define('_STR_MIN_LEN', 2);
define('_STR_MAX_LEN', 30);

include_once __DIR__ . '/classes/DBConnection.php';

function _respond(string $message='', int $status=200) {
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
        !isset($session['user_is_admin']) ||
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

function _getTapwall(): array {
    try{
        $db = new DB;
        $db = $db->connect();
    
        $query = $db->prepare('SELECT * FROM beers_and_breweries WHERE beer_is_active = 1');
        $query->execute();
    
        $beers = $query->fetchAll();
        return $beers;
    } catch (Exception $ex) {
        _respond('Server error.', 500);
    }
}