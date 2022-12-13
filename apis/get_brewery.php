<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($brewery_id)) _respond('Invalid brewery id.', 400);
if (!in_array($_SESSION['user_role'], ['1', '2'])) _respond('Unauthorized attempt.', 401);

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('SELECT * FROM breweries WHERE brewery_id = :brewery_id LIMIT 1');
    $query->bindValue(':brewery_id', $brewery_id);
    $query->execute();

    $brewery = $query->fetch();

    if (!$brewery) {
        _respond('Brewery does not exist.', 400);
    }

    _respond($brewery, 200);
    
} catch(Exception $ex) {
    _respond($ex, 500);
}