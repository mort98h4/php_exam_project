<?php 
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/User.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($user_id)) _respond('Invalid user id.', 400);
if ($_SESSION['user_id'] !== $user_id) _respond('Unauthorized attempt.', 401);

try {
    $user = new User;

    if (!$user->setPassword(
        isset($_POST['password']) ? $_POST['password'] : '', 
        isset($_POST['password']) ? $_POST['password'] : ''
    )) {
        _respond('Invalid password.', 400);
    }
    if (!$user->setPassword(
        isset($_POST['new_password']) ? $_POST['new_password'] : '', 
        isset($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : ''
    )) {
        _respond('New password is invalid.', 400);
    }

} catch(Exception $ex) {
    _respond('Server error.', 500);
}

try {
    $db = new DB;
    $db = $db->connect();
    $db->beginTransaction();

    $query = $db->prepare('SELECT user_password FROM users WHERE user_id = :user_id LIMIT 1');
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    $dbPassword = $query->fetch()['user_password'];
    if (!$dbPassword) {
        _respond('', 204);
    }
    if (!password_verify($_POST['password'], $dbPassword)) {
        _respond('Password is incorrect.', 400);
    }

    $query = $db->prepare('UPDATE users SET user_password = :new_password WHERE user_id = :user_id');
    $query->bindValue(':new_password', $user->password());
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    if ($query->rowCount() == 0) {
        $db->rollBack();
        _respond('', 204);
    }

    $db->commit();

    _respond('Password was updated.', 200);

} catch(Exception $ex) {
    $db->rollBack();
    _respond('Server error.', 500);
}