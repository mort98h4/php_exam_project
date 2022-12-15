<?php

$title = 'Editor';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';

if (!$validSession) _redirect('/');
if (!$editor) _redirect('/');

$breweries = _getBreweries();
$beers = _getBeers();
?>

<div class="container grid grid-cols-12 mx-auto mt-12 gap-4 px-4 pb-4 relative">
    <?php include_once __DIR__ . '/templates/sidemenu.php'; ?>
    <main class="col-span-12 sm:col-span-9 lg:col-span-8 xl:col-span-6 xl:col-start-4 pt-4">
        <h1 class="text-3xl font-medium">Editor panel</h1>
        <section id="allBreweries" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">All breweries</h2>
            <?php include_once __DIR__ . '/templates/all_breweries.php' ; ?>
        </section>
        <hr class="mt-8 opacity-50" />
        <section id="createBrewery" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">Create new brewery</h2>
            <?php include_once __DIR__ . '/templates/form_create_brewery.php'; ?>
        </section>
        <hr class="mt-12 opacity-50" />
        <section id="allBeers" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">All beers</h2>
            <?php include_once __DIR__ . '/templates/all_beers.php'; ?>
        </section>
        <hr class="mt-8 opacity-50" />
        <section id="createBeer" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">Create new beer</h2>
            <?php include_once __DIR__ . '/templates/form_create_beer.php' ?>
        </section>
    </main>
</div>

<?php 
include_once __DIR__ . '/templates/modal_update_brewery.php';
include_once __DIR__ . '/templates/modal_update_beer.php';
include_once __DIR__ . '/templates/modal_delete_brewery.php';
include_once __DIR__ . '/templates/modal_delete_beer.php';
include_once __DIR__ . '/templates/templates.php';
include_once __DIR__ . '/templates/footer.php';