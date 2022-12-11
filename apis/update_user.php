<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/User.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($user_id)) _respond('Invalid user id.', 400);
if (($_SESSION['user_id'] !== $user_id) && ($_SESSION['user_role'] !== '1')) _respond('Unauthorized attempt.', 401); 

try {
    $user = new User;

    if (!$user->setFirstName($_POST['first_name'])) {
        _respond('Invalid first name', 400);
    }
    if (!$user->setLastName($_POST['last_name'])) {
        _respond('Invalid last name.', 400);
    }
    if (!$user->setEmail($_POST['email'])) {
        _respond('Invalid e-mail.', 400);
    }
    if (!$user->setRole(intval($_POST['role_id']))) {
        _respond('Invalid role id.', 400);
    }
} catch (Exception $ex) {
    _respond($ex, 500);
}

try {
    $db = new DB;
    $db = $db->connect();
    $db->beginTransaction();

    $query = $db->prepare('SELECT * FROM users_and_roles WHERE user_id = :user_id LIMIT 1');
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    $dbUser = $query->fetch();
    if (!$dbUser) {
        $db->rollBack();
        _respond('', 204);
    }

    $query = $db->prepare('UPDATE users SET user_first_name = :first_name, user_last_name = :last_name, user_email = :email, user_role = :role_id WHERE user_id = :user_id');
    $query->bindValue(
        ':first_name', 
        ($user->firstName() != $dbUser['user_first_name']) ? $user->firstName() : $dbUser['user_first_name']
    );
    $query->bindValue(
        ':last_name',
        ($user->lastName() != $dbUser['user_last_name']) ? $user->lastName() : $dbUser['user_last_name']
    );
    $query->bindValue(
        ':email',
        ($user->email() != $dbUser['user_email']) ? $user->email() : $dbUser['user_email']
    );
    $query->bindValue(
        ':role_id',
        ($user->role() != $dbUser['role_id']) ? $user->role() : $dbUser['role_id']
    );
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    if ($query->rowCount() == 0) {
        $db->rollBack();
        _respond('', 204);
    }

    $query = $db->prepare('SELECT * FROM users_and_roles WHERE user_id = :user_id');
    $query->bindValue(':user_id', $user_id);
    $query->execute();
    $updatedUser = $query->fetch();

    $db->commit();
    echo json_encode($updatedUser);

} catch(Exception $ex) {
    $db->rollBack();
    _respond($ex, 500);
}