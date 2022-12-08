<?php


// include_once __DIR__ . '/../classes/Beer.php';
// include_once __DIR__ . '/../apis/get_beers.php';
include_once __DIR__ . '/../utils.php';
$title = 'Tapwall';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';

$beers = _getTapwall();
?> 
<main class="container mx-auto p-4 mt-12">
    <?php foreach($beers as $beer) { ?>
    <div>
        <?= out($beer['beer_name']) ?>
    </div>
    <?php } ?>
</main>