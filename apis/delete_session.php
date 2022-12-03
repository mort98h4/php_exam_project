<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

if (!$_SESSION) { _redirect('/'); }
if ($user_id !== $_SESSION['user_id']) { _redirect('/'); } 

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('DELETE FROM sessions WHERE session_id = :session_id AND session_user_id = :user_id');
    $query->bindValue(':session_id', $_SESSION['session_id']);
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    session_destroy();
    $_SESSION = false;
    _respond('', 204);
    // _redirect('/');
} catch(Exception $ex) {
    _respond('Server error.', 500);
}