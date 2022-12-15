<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($offset)) _respond('Invalid offset.', 400);
if (!in_array($_SESSION['user_role'], ['1', '2'])) _respond('Unauthorized attempt.', 401);

try {
    $db = new DB;
    $db = $db->connect();

    $offset = intval($offset);
    $query = $db->prepare('SELECT * FROM breweries ORDER BY brewery_name LIMIT 10 OFFSET :offset');
    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
    $query->execute();

    $breweries = $query->fetchAll();

    if (!$breweries) {
        _respond('', 204);
    }

    _respond($breweries, 200);
} catch(Exception $ex) {
    _respond($ex, 500);
}