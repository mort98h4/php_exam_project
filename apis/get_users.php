<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($offset)) _respond('Invalid offset.', 400);
if (intval($_SESSION['user_role']) !== 1) _respond('Unauthorized attempt.', 401); 

try {
    $db = new DB;
    $db = $db->connect();

    $query = $db->prepare('SELECT * FROM users_and_roles ORDER BY user_id ASC LIMIT 5 OFFSET :offset');
    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
    $query->execute();

    $users = $query->fetchAll();

    if (!$users) {
        _respond('', 204);
    }
    
    _respond($users, 200);
} catch(PDOException $ex) {
    http_response_code(500);
    $message = [
        'info'=>'Error in line: ' . __LINE__,
        'ex'=>$ex
    ];
    echo json_encode($message);
}
