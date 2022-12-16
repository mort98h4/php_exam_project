<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/Brewery.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!in_array($_SESSION['user_role'], ['1', '2'])) _respond('Unauthorized attempt.', 401);

try {
    $brewery = new Brewery;
    if (!$brewery->setName(isset($_POST['name']) ? $_POST['name'] : '')) {
        _respond('Invalid name.', 400);
    }
} catch(Exception $ex) {
    _respond('Server error.', 500);
}

try {
    $db = new DB;
    $db = $db->connect();
    $db->beginTransaction();

    $query = $db->prepare('INSERT INTO breweries (brewery_name) VALUES(:name)');
    $query->bindValue(':name', $brewery->name());
    $query->execute();

    $brewery_id = $db->lastInsertId();

    $query = $db->prepare('SELECT * FROM breweries WHERE brewery_id = :brewery_id LIMIT 1');
    $query->bindValue(':brewery_id', $brewery_id);
    $query->execute();

    $brewery = $query->fetch();

    $db->commit();
    _respond($brewery, 201);

} catch(Exception $ex) {
    $db->rollBack();
    _respond('Server error.', 500);
}