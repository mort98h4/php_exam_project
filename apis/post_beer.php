<?php
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/Beer.php';
require_once __DIR__ . '/../classes/DBConnection.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!in_array($_SESSION['user_role'], ['1', '2'])) _respond('Unauthorized attempt.', 401);

try {
    $beer = new Beer;

    $breweryId = isset($_POST['brewery_id']) ? intval($_POST['brewery_id']) : -1;
    if (!$beer->setBrewery($breweryId)) {
        _respond('Invalid brewery id.', 400);
    }

    $style = isset($_POST['style']) ? $_POST['style'] : '';
    if (!$beer->setStyle($style)) {
        _respond('Invalid style.', 400);
    }

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    if (!$beer->setName($name)) {
        _respond('Invalid name.', 400);
    }

    $IBU = isset($_POST['ibu']) ? intval($_POST['ibu']) : -1;
    if (!$beer->setIBU($IBU)) {
        _respond('Invalid IBU', 400);
    }

    $EBC = isset($_POST['ebc']) ? intval($_POST['ebc']) : -1;
    if (!$beer->setEBC($EBC)) {
        _respond('Invalid EBC.', 400);
    }

    $volume = isset($_POST['volume']) ? $_POST['volume'] : -1;
    if (!$beer->setVolume($volume)) {
        _respond('Invalid volume.', 400);
    }

    $description = isset($_POST['description']) ? $_POST['description'] : '';
    if (!$beer->setDescription($description)) {
        _respond('Invalid description.', 400);
    }

    $image = ((isset($_FILES['image'])) && $_FILES['image']['tmp_name'] !== '') ? _validateImage($_FILES['image']) : '';
    if ((!$image === '') && (!$beer->setImageStr($image))) {
        _respond('Invalid image name.', 400);
    }

    $createdBy = isset($_POST['user_id']) ? intval($_POST['user_id']) : -1;
    if (!$beer->setCreatedBy($createdBy)) {
        _respond('Invalid user id.', 400);
    }

    $createdAt = time();
    $updatedAt = '';

    $isActive = isset($_POST['is_active']) ? intval($_POST['is_active']) : -1;
    if (!$beer->setIsActive($isActive)) {
        _respond('Invalid active value.', 400);
    }

    $tapwallNo = isset($_POST['tapwall_no']) ? intval($_POST['tapwall_no']) : -1;
    if (!$beer->setTapwallNo($tapwallNo)) {
        _respond('Invalid tapwall no.', 400);
    }
    $price = isset($_POST['price']) ? floatval($_POST['price']) : -1;
    if (!$beer->setPrice($price)) {
        _respond('Invalid price.', 400);
    }

    if (!$createdBy === intval($_SESSION['user_id'])) {
        _respond('Unauthorized attempt.', 401);
    }

} catch(Exception $ex) {
    _respond('Server error.', 500);
}

try {
    $db = new DB;
    $db = $db->connect();

    $db->beginTransaction();

    $query = $db->prepare('SELECT * FROM breweries WHERE brewery_id = :brewery_id LIMIT 1');
    $query->bindValue(':brewery_id', $breweryId);
    $query->execute();

    if ($query->rowCount() === 0) {
        $db->rollBack();
        _respond('Brewery does not exist.', 400);
    }

    $query = $db->prepare('SELECT * FROM user_sessions WHERE user_id = :user_id LIMIT 1');
    $query->bindValue(':user_id', $createdBy);
    $query->execute();

    if ($query->rowCount() === 0) {
        $db->rollBack();
        _respond('User does not exist.', 400);
    }

    $query = $db->prepare('INSERT INTO beers (beer_brewery_id, beer_style, beer_name, beer_ibu, beer_ebc, beer_volume, beer_description, beer_image, beer_created_by, beer_created_at, beer_updated_at, beer_is_active, beer_tapwall_no, beer_price) VALUES (:brewery_id, :style, :name, :ibu, :ebc, :volume, :description, :image, :created_by, :created_at, :updated_at, :is_active, :tapwall_no, :price)');
    $query->bindValue(':brewery_id', $breweryId);
    $query->bindValue(':style', $style);
    $query->bindValue(':name', $name);
    $query->bindValue(':ibu', $IBU);
    $query->bindValue(':ebc', $EBC);
    $query->bindValue(':volume', $volume);
    $query->bindValue(':description', $description);
    $query->bindValue(':image', $image);
    $query->bindValue(':created_by', $createdBy);
    $query->bindValue(':created_at', $createdAt);
    $query->bindValue(':updated_at', $updatedAt);
    $query->bindValue(':is_active', $isActive);
    $query->bindValue(':tapwall_no', $tapwallNo);
    $query->bindValue(':price', $price);
    $query->execute();

    $beer_id = $db->lastInsertId();

    $query = $db->prepare('SELECT * FROM beers_and_breweries WHERE beer_id = :beer_id LIMIT 1');
    $query->bindValue(':beer_id', $beer_id);
    $query->execute();

    $beer = $query->fetch();

    $db->commit();
    _respond($beer, 201);
} catch(Exception $ex) {
    $db->rollBack();
    _respond('Server error.', 500);
}