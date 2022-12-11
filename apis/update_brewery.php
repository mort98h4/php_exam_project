<?php 
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/Brewery.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($brewery_id)) _respond('Invalid brewery id', 400);
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

    $query = $db->prepare('SELECT * FROM breweries WHERE brewery_id = :brewery_id LIMIT 1');
    $query->bindValue(':brewery_id', $brewery_id);
    $query->execute();

    $dbBrewery = $query->fetch();
    if (!$dbBrewery) {
        $db->rollBack();
        _respond('', 204);
    }

    $query = $db->prepare('UPDATE breweries SET brewery_name = :name WHERE brewery_id = :brewery_id');
    $query->bindValue(
        ':name',
        ($brewery->name() != $dbBrewery['brewery_name']) ? $brewery->name() : $dbBrewery['brewery_name']
    );
    $query->bindValue(':brewery_id', $brewery_id);
    $query->execute();

    if ($query->rowCount() == 0) {
        $db->rollBack();
        _respond('', 204);
    }

    $query = $db->prepare('SELECT * FROM breweries WHERE brewery_id = :brewery_id LIMIT 1');
    $query->bindValue(':brewery_id', $brewery_id);
    $query->execute();
    $updatedBrewery = $query->fetch();

    $db->commit();
    echo json_encode($updatedBrewery);

} catch(Exception $ex) {
    $db->rollBack();
    _respond($ex, 500);
}
