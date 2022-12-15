<?php 
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt', 401);
if (!is_numeric($user_id)) _respond('Invalid user id.', 400);
if (($_SESSION['user_id'] !== $user_id) && (intval($_SESSION['user_role']) !== 1)) _respond('Unauthorized attempt.', 401);

try {
    $db = new DB;
    $db = $db->connect();
    $db->beginTransaction();

    $query = $db->prepare('DELETE FROM users WHERE user_id = :user_id');
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    if ($query->rowCount() == 0) {
        $db->rollBack();
        _respond('', 204);
    }

    if ($_SESSION['user_id'] == $user_id) {
        $query = $db->prepare('DELETE FROM sessions WHERE session_id = :session_id');
        $query->bindValue(':session_id', $_SESSION['session_id']);
        $query->execute();

        if ($query->rowCount() == 0) {
            $db->rollBack();
            _respond('', 204);
        }

        session_destroy();
    }

    $db->commit();
    _respond('User deleted.', 200);
} catch(Exception $ex) {
    $db->rollBack();
    _respond('Server error.', 500);
}