<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($user_id)) _respond('Invalid user id.', 400);
if ($user_id !== $_SESSION['user_id']) _respond('Unauthorized attempt.', 401);

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('DELETE FROM sessions WHERE session_id = :session_id AND session_user_id = :user_id');
    $query->bindValue(':session_id', $_SESSION['session_id']);
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    if ($query->rowCount() == 0) {
        _respond('', 204);
    } 

    session_destroy();
    _respond('Session deleted', 200);
} catch(Exception $ex) {
    _respond('Server error.', 500);
}