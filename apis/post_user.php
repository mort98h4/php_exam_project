<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/User.php';

try {
    $user = new User;

    if (!$user->setFirstName(isset($_POST['first_name']) ? $_POST['first_name'] : '')) {
        _respond('Invalid first name.', 400);
    }
    if (!$user->setLastName(isset($_POST['last_name']) ? $_POST['last_name'] : '')) {
        _respond('Invalid last name.', 400);
    }
    if (!$user->setEmail(isset($_POST['email']) ? $_POST['email'] : '')) {
        _respond('Invalid e-mail.', 400);
    }
    if (!$user->setPassword(
            isset($_POST['password']) ? $_POST['password'] : '', 
            isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''
        )) {
        _respond('Invalid password.', 400);
    }
    if (!$user->setRole(isset($_POST['role']) ? intval($_POST['role']) : 3)) {
        _respond('Invalid role.', 400);
    }

} catch(Exception $ex) {
    _respond($ex, 500);
}

try {
    $db = new DB;
    $db = $db->connect();
    $db->beginTransaction();

    $query = $db->prepare('INSERT INTO users (user_first_name, user_last_name, user_email, user_password, user_role) VALUES (:first_name, :last_name, :email, :password, :role)');
    $query->bindValue(':first_name', $user->firstName());
    $query->bindValue(':last_name', $user->lastName());
    $query->bindValue(':email', $user->email());
    $query->bindValue(':password', $user->password());
    $query->bindValue(':role', $user->role());
    $query->execute();

    $user_id = $db->lastInsertId();
    $query = $db->prepare('INSERT INTO sessions (session_user_id) VALUES (:user_id)');
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    $session_id = $db->lastInsertId();
    $query = $db->prepare('SELECT * FROM user_sessions WHERE user_id = :user_id AND session_id = :session_id');
    $query->bindValue(':user_id', $user_id);
    $query->bindValue(':session_id', $session_id);
    $query->execute();

    if (!_validateSession($_SESSION)) {
        $_SESSION = $query->fetch();
    }

    $db->commit();
    _respond('User created', 201);

} catch(Exception $ex) {
    if (str_contains($ex, 'email')) _respond('Email already exists.', 400);
    _respond('Server error', 500);
}

