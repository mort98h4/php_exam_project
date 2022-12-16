<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($user_id)) _respond('Invalid user id.', 400);
if (($_SESSION['user_id'] !== $user_id) && (intval($_SESSION['user_role']) !== 1)) _respond('Unauthorized attempt.', 401);

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

    _respond($user, 200);
} catch(Exception $ex) {
    _respond('Server error.', 500);
}