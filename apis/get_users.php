<?php

require_once __DIR__ . '/../classes/DBConnection.php';

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('SELECT * FROM users');
    $query->execute();

    $users = $query->fetchAll();
    header('Content-Type: application/json');
    http_response_code(200);

    echo json_encode(($users));

} catch(PDOException $ex) {
    http_response_code(200);
    $message = [
        'info'=>'Error in line: ' . __LINE__,
        'ex'=>$ex
    ];
    echo json_encode($message);
}
