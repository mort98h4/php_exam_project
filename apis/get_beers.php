<?php 
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('SELECT * FROM beers_and_breweries');
    $query->execute();

    $beers = $query->fetchAll();
    echo json_encode($beers);
    header('Content-Type: application/json');
    http_response_code(200);
} catch(Exception $ex) {
    _respond($ex, 500);
}