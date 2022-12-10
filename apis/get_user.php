<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

if (!is_numeric($user_id)) {
    _respond('Invalid user id.', 400);
}

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('SELECT * FROM users_and_roles WHERE user_id = :user_id LIMIT 1');
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    $user = $query->fetch();

    if (!$user) {
        _respond('User does not exist.', 400);
    }

    echo json_encode($user);
    header('Content-Type: application/json');
    http_response_code(200);
} catch(Exception $ex) {
    _respond($ex, 500);
}