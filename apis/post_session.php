<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/User.php';

try {
    $user = new User;
    if (!$user->setEmail($_POST['email'])) {
        _respond('Invalid e-mail.', 400);
    }

    if (!$user->setPassword($_POST['password'], $_POST['password'])) {
        _respond('Invalid password.', 400);
    }

} catch(Exception $ex) {
    _respond('Server error.', 500);
}

try {
    $db = new DB;
    $db = $db->connect();

    $db->beginTransaction();
    
    $query = $db->prepare('SELECT user_id, user_password FROM users WHERE user_email = :email LIMIT 1');
    $query->bindValue(':email', $user->email());
    $query->execute();
    
    $response = $query->fetch();
    if (!$response) _respond('E-mail does not exist.', 400);

    $db_password = $response['user_password'];
    if (!password_verify($_POST['password'], $db_password)) {
        _respond('Password is incorrect.', 400);
    }

    $user_id = $response['user_id'];
    $query = $db->prepare('INSERT INTO sessions (session_user_id) VALUES (:user_id)');
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    $session_id = $db->lastInsertId();

    $query = $db->prepare('SELECT * FROM user_sessions WHERE user_id = :user_id AND session_id = :session_id');
    $query->bindValue(':user_id', $user_id);
    $query->bindValue(':session_id', $session_id);
    $query->execute();
    $_SESSION = $query->fetch();

    $db->commit();
    _respond('Session created.', 200);
} catch(Exception $ex) {
    $db->rollBack();
    _respond('Server error.', 500);
}