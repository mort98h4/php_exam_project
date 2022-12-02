<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/User.php';

try {
    $user = new User;

    if (!$user->setFirstName($_POST['first_name'])) {
        _respond('Invalid first name.', 400);
    };
    if (!$user->setLastName($_POST['last_name'])) {
        _respond('Invalid last name.', 400);
    };
    if (!$user->setEmail($_POST['email'])) {
        _respond('Invalid e-mail.', 400);
    };
    if (!$user->setPassword($_POST['password'], $_POST['confirm_password'])) {
        _respond('Password was not set.', 400);
    }
} catch(Exception $ex) {
    _respond($ex, 500);
}

try {
    $db = new DB;
    $db = $db->connect();
    $db->beginTransaction();

    $query = $db->prepare('INSERT INTO users (user_first_name, user_last_name, user_email, user_password, user_is_admin) VALUES (:first_name, :last_name, :email, :password, :is_admin)');
    $query->bindValue(':first_name', $user->firstName());
    $query->bindValue(':last_name', $user->lastName());
    $query->bindValue(':email', $user->email());
    $query->bindValue(':password', $user->password());
    $query->bindValue(':is_admin', 0);
    $query->execute();

    $user_id = $db->lastInsertId();
    $query = $db->prepare('INSERT INTO sessions (session_user_id) VALUES (:user_id)');
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    $query = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $query->bindValue(':user_id', $user_id);
    $query->execute();
    $_SESSION = $query->fetch();

    $db->commit();
    _respond('User created', 201);

} catch(Exception $ex) {
    if (str_contains($ex, 'email')) _respond('Email already exists.', 400);
    _respond('Server error', 500);
}

