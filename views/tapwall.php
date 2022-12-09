<?php

$title = 'Tapwall';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';

$beers = _getTapwall();
$breweries = _getBreweries();

?> 
<main class="container mx-auto p-4 mt-12">
    <div class="tapwall">
        <div class="row-span-1 col-span-12 text-center border-b border-b-white p-4">
            <h1 class="text-3xl font-medium">Tapwall</h1>
        </div>
        <div class="row font-medium">
            <div class="col-span-1">
                No.
            </div>
            <div class="col-span-2">
                Style
            </div>
            <div class="col-span-2 md:col-span-3">
                Name
            </div>
            <div class="col-span-2">
                Brewery
            </div>
            <div class="col-span-1">
                IBU
            </div>
            <div class="col-span-1">
                EBC
            </div>
            <div class="col-span-1">
                Vol.
            </div>
            <div class="col-span-2 md:col-span-1">
                DKK
            </div>
        </div>
        <?php foreach($beers as $beer) { ?>
        <div id="beer_<?= out($beer['beer_id']) ?>" class="row text-black font-medium">
            <div class="col-span-1 text-white">
                <?= out($beer['beer_tapwall_no']) ?>
            </div>
            <div class="col-span-2 bg-yellow-300">
                <?= out($beer['beer_style']) ?>
            </div>
            <div class="col-span-2 md:col-span-3 bg-teal-400">
                <?= out($beer['beer_name']) ?>
            </div>
            <div class="col-span-2 bg-lime-400">
                <?= out($beer['brewery_name']) ?>
            </div>
            <div class="col-span-1 bg-red-500">
                <?= out($beer['beer_ibu']) ?>
            </div>
            <div class="col-span-1 bg-sky-400">
                <?= out($beer['beer_ebc']) ?>
            </div>
            <div class="col-span-1 bg-orange-400">
                <?= out($beer['beer_volume']) ?>
            </div>
            <div class="col-span-2 md:col-span-1 bg-blue-500">
                <?= out($beer['beer_price']) ?> DKK
            </div>
        </div>
        <?php } ?>
    </div>
    
</main>

<?php
include_once __DIR__ . '/templates/login_modal.php';
include_once __DIR__ . '/templates/footer.php';