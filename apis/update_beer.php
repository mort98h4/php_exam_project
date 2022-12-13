<?php 
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../classes/DBConnection.php';
require_once __DIR__ . '/../classes/Beer.php';

$validSession = _validateSession($_SESSION);
if (!$validSession) _respond('Unauthorized attempt.', 401);
if (!is_numeric($beer_id)) _respond('Invalid beer id', 400);
if (!in_array($_SESSION['user_role'], ['1', '2'])) _respond('Unauthorized attempt.', 401);

try {
    $beer = new Beer;

    if (!$beer->setBrewery(isset($_POST['brewery_id']) ? intval($_POST['brewery_id']) : -1)) {
        _respond('Invalid brewery id.', 400);
    }
    if (!$beer->setName(isset($_POST['name']) ? $_POST['name'] : '')) {
        _respond('Invalid name.', 400);
    }
    if (!$beer->setStyle(isset($_POST['style']) ? $_POST['style'] : '')) {
        _respond('Invalid style', 400);
    }
    if (!$beer->setVolume(isset($_POST['volume']) ? $_POST['volume'] : -1)) {
        _respond('Invalid volume.', 400);
    }
    if (!$beer->setIBU(isset($_POST['ibu']) ? intval($_POST['ibu']) : -1)) {
        _respond('Invalid IBU.', 400);
    }
    if (!$beer->setEBC(isset($_POST['ebc']) ? intval($_POST['ebc']) : -1)) {
        _respond('Invalid EBC.', 400);
    }
    if (!$beer->setIsActive(isset($_POST['is_active']) ? intval($_POST['is_active']) : -1)) {
        _respond('Invalid active value.', 400);
    }
    if (!$beer->setTapwallNo(isset($_POST['tapwall_no']) ? intval($_POST['tapwall_no']) : -1)) {
        _respond('Invalid tapwall no.', 400);
    }
    if (!$beer->setPrice(isset($_POST['price']) ? floatval($_POST['price']) : -1 )) {
        _respond('Invalid price.', 400);
    }
    if (!$beer->setDescription(isset($_POST['description']) ? $_POST['description'] : '')) {
        _respond('Invalid description.', 400);
    }
    if (!$beer->setCreatedBy(isset($_POST['created_by']) ? intval($_POST['created_by']) : -1)) {
        _respond('Invalid user id.', 400);
    }
    if (!$beer->setCreatedAt(isset($_POST['created_at']) ? intval($_POST['created_at']) : -1)) {
        _respond('Invalid created at time.', 400);
    }
    if (!$beer->setUpdatedAt(isset($_POST['updated_at']) ? $_POST['updated_at'] : "")) {
        _respond('Invalid update time.', 400);
    }
    $oldImage = isset($_POST['beer_image']) ? $_POST['beer_image'] : '';
    if (($oldImage !== '') && (!$beer->setImageStr($oldImage))) {
        _respond('Invalid old image name.', 400);
    }
    $newImage = ((isset($_FILES['image'])) && $_FILES['image']['tmp_name'] !== '') ? _validateImage($_FILES['image']) : $oldImage;
    if (($newImage !== '') && (!$beer->setImageStr($newImage))) {
        _respond('Invalid image name.', 400);
    }

    $newBeer = [
        'beer_id' => $beer_id,
        'beer_brewery_id' => $beer->breweryId(),
        'beer_style' => $beer->style(),
        'beer_name' => $beer->name(),
        'beer_ibu' => $beer->IBU(),
        'beer_ebc' => $beer->EBC(),
        'beer_volume' => $beer->volume(),
        'beer_description' => $beer->description(),
        'beer_image' => $beer->image(),
        'beer_created_by' => $beer->createdBy(),
        'beer_created_at' => $beer->createdAt(),
        'beer_updated_at' => $beer->updatedAt(),
        'beer_is_active' => $beer->isActive(),
        'beer_tapwall_no' => $beer->tapwallNo(),
        'beer_price' => $beer->price()
    ];

} catch(Exception $ex) {
    _respond('Server error.', 500);
}

try {
    $db = new DB;
    $db = $db->connect();
    $db->beginTransaction();

    $query = $db->prepare('SELECT * FROM beers WHERE beer_id = :beer_id LIMIT 1');
    $query->bindValue(':beer_id', $beer_id);
    $query->execute();

    $dbBeer = $query->fetch();
    if (!$dbBeer) {
        $db->rollBack();
        _respond('', 204);
    }
    if ($newBeer === $dbBeer) {
        $db->rollBack();
        _respond('No data to update.', 400);
    }

    if (!$beer->setUpdatedAt(strval(time()))) {
        _respond('Invalid updated at value.', 500);
    }
    $newBeer['beer_updated_at'] = $beer->updatedAt();
    if ($newBeer['beer_is_active'] === '0') {
        $newBeer['beer_tapwall_no'] = '0';
    }

    $query = $db->prepare('UPDATE beers SET beer_brewery_id = :brewery_id, beer_style = :style, beer_name = :name, beer_ibu = :ibu, beer_ebc = :ebc, beer_volume = :volume, beer_description = :description, beer_image = :image, beer_updated_at = :updated_at, beer_is_active = :is_active, beer_tapwall_no = :tapwall_no, beer_price = :price WHERE beer_id = :beer_id');
    $query->bindValue(':brewery_id', $newBeer['beer_brewery_id']);
    $query->bindValue(':style', $newBeer['beer_style']);
    $query->bindValue(':name', $newBeer['beer_name']);
    $query->bindValue(':ibu', $newBeer['beer_ibu']);
    $query->bindValue(':ebc', $newBeer['beer_ebc']);
    $query->bindValue(':volume', $newBeer['beer_volume']);
    $query->bindValue(':description', $newBeer['beer_description']);
    $query->bindValue(':image', $newBeer['beer_image']);
    $query->bindValue(':updated_at', $newBeer['beer_updated_at']);
    $query->bindValue(':is_active', $newBeer['beer_is_active']);
    $query->bindValue(':tapwall_no', $newBeer['beer_tapwall_no']);
    $query->bindValue(':price', $newBeer['beer_price']);
    $query->bindValue(':beer_id', $newBeer['beer_id']);
    $query->execute();

    $query = $db->prepare('SELECT * FROM beers_and_breweries WHERE beer_id = :beer_id LIMIT 1');
    $query->bindValue(':beer_id', $newBeer['beer_id']);
    $query->execute();
    $updatedBeer = $query->fetch();

    if ($dbBeer['beer_image'] !== '' && $dbBeer['beer_image'] !== $updatedBeer['beer_image']) {
        if (!_deleteImage($dbBeer['beer_image'])) _respond('Image not deleted.', 500);
    }

    $db->commit();
    _respond($updatedBeer, 200);
} catch(Exception $ex) {
    $db->rollBack();
    _respond('Server error.', 500);
}