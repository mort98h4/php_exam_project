<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt', 401);
if (!is_numeric($beer_id)) _respond('Invalid beer id.', 400);
if (!in_array($_SESSION['user_role'], ['1', '2'])) _respond('Unauthorized attempt.', 401);

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('SELECT * FROM beers_and_breweries WHERE beer_id = :beer_id LIMIT 1');
    $query->bindValue(':beer_id', $beer_id);
    $query->execute();

    $beer = $query->fetch();

    if (!$beer) {
        _respond('Beer does not exist.', 400);
    }

    _respond($beer, 200);

} catch(Exception $ex) {
    _respond('Server error.', 500);
}