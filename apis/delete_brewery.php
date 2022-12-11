<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($brewery_id)) _respond('Invalid brewery id.', 401);
if (!in_array($_SESSION['user_role'], ['1', '2'])) _respond('Unauthorized attempt.', 401);

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('DELETE FROM breweries WHERE brewery_id = :brewery_id');
    $query->bindValue(':brewery_id', $brewery_id);
    $query->execute();

    if ($query->rowCount() == 0) {
        _respond('', 204);
    } 

    _respond('Brewery deleted.', 200);
} catch(Exception $ex) {
    _respond('Server error.', 500);
}