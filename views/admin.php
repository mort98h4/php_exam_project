<?php

$title = 'Admin';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';

if (!$validSession) _redirect('/');
if (!$admin) _redirect('/');
$users = _getUsers();
$breweries = _getBreweries();
$beers = _getBeers();
?>

<div class="container grid grid-cols-12 mx-auto mt-12 gap-4 px-4 pb-4 relative">
    <?php include_once __DIR__ . '/templates/sidemenu.php'; ?>
    <main class="col-span-12 sm:col-span-9 lg:col-span-8 xl:col-span-6 xl:col-start-4 pt-4">
        <h1 class="text-3xl font-medium ">Admin panel</h1>
        <section id="allUsers" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">All users</h2>

            <?php foreach($users as $user) { ?>
            <article id="user_<?= out($user['user_id']) ?>" class="user">
                <header class="flex items-center justify-between">
                    <h3 class="text-xl font-medium mb-2"><?= out($user['user_first_name']) ?> <?= out($user['user_last_name']) ?></h3>
                    <div>
                        <button class="btn-icon mr-2" onclick="toggleUpdateModal()" data-target="#update_user_modal" data-table="users" data-id="<?= out($user['user_id']) ?>" >
                            <i class="fa-sharp fa-solid fa-pen-to-square pointer-events-none"></i>
                        </button>
                        <button class="btn-icon text-red-600" onclick="toggleDeleteModal()" data-target="#delete_user_modal" data-id="<?= out($user['user_id']) ?>">
                            <i class="fa-sharp fa-solid fa-trash pointer-events-none"></i>
                        </button>
                    </div>
                </header>
                <div class="grid grid-cols-2 gap-4 items-start">
                    <div class="col-span-1">
                        <h4 class="font-medium opacity-70 uppercase">E-mail</h4>
                        <p class="email">
                            <?= out($user['user_email']) ?>
                        </p>
                    </div>
                    <div class="col-span-1">
                        <h4 class="font-medium opacity-70 uppercase">Role</h4>
                        <p class="role">
                            <?= out($user['role_name']) ?>
                        </p>
                    </div>
                </div>
            </article>
            <?php } ?>

        </section>

        <section id="createUser" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">Create new user</h2>
            <?php include_once __DIR__ . '/templates/form_create_user.php'; ?>
        </section>

        <section id="allBreweries" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">All breweries</h2>
            
            <?php foreach($breweries as $brewery) { ?>
            <article id="brewery_<?= out($brewery['brewery_id']) ?>" class="brewery">
                <header class="flex items-center justify-between">
                    <h3 class="text-xl font-medium mb-2"><?= out($brewery['brewery_name']) ?></h3>
                    <div>
                        <button class="btn-icon mr-2" onclick="toggleUpdateModal()" data-target="#update_brewery_modal" data-table="breweries" data-id="<?= out($brewery['brewery_id']) ?>" >
                            <i class="fa-sharp fa-solid fa-pen-to-square pointer-events-none"></i>
                        </button>
                        <button class="btn-icon text-red-600" onclick="toggleDeleteModal()" data-target="#delete_brewery_modal" data-id="<?= out($brewery['brewery_id']) ?>">
                            <i class="fa-sharp fa-solid fa-trash pointer-events-none"></i>
                        </button>
                    </div>
                </header>
            </article>
            <?php } ?>
        </section>

        <section id="createBrewery" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">Create new brewery</h2>
            <?php include_once __DIR__ . '/templates/form_create_brewery.php'; ?>
        </section>

        <section id="allBeers" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">All beers</h2>
            <?php foreach($beers as $beer) { ?>

            <article id="beer_<?= out($beer['beer_id']) ?>" class="beer">
                <header class="flex items-center justify-between">
                    <h3 class="text-xl font-medium mb-2"><?= out($beer['beer_name']) ?></h3>
                    <div>
                        <button class="btn-icon mr-2" onclick="toggleUpdateModal()" data-target="#update_beer_modal" data-table="beers" data-id="<?= out($beer['beer_id']) ?>">
                            <i class="fa-sharp fa-solid fa-pen-to-square pointer-events-none"></i>
                        </button>
                        <button class="btn-icon text-red-600" onclick="toggleDeleteModal()" data-target="#delete_beer_modal" data-id="<?= out($beer['beer_id']) ?>">
                            <i class="fa-sharp fa-solid fa-trash pointer-events-none"></i>
                        </button>
                    </div>
                </header>

                <div class="grid grid-cols-8 gap-2 items-start">
                    <div class="col-span-4 md:col-span-2">
                        <h4 class="font-medium opacity-70 uppercase">Brewery</h4>
                        <p class="beerBrewery">
                            <?= out($beer['brewery_name']) ?>
                        </p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <h4 class="font-medium opacity-70 uppercase">Style</h4>
                        <p class="style">
                            <?= out($beer['beer_style']) ?>
                        </p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <h4 class="font-medium opacity-70 uppercase">IBU</h4>
                        <p class="ibu">
                            <?= $beer['beer_ibu'] ? out($beer['beer_ibu']) : '-' ?>
                        </p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <h4 class="font-medium opacity-70 uppercase">EBC</h4>
                        <p class="ebc">
                            <?= $beer['beer_ebc'] ? out($beer['beer_ebc']) : '-' ?>
                        </p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <h4 class="font-medium opacity-70 uppercase">Volume</h4>
                        <p class="volume">
                            <?= out($beer['beer_volume']) ?>%
                        </p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <h4 class="font-medium opacity-70 uppercase">Price</h4>
                        <p class="price">
                            <?= out($beer['beer_price']) ?> DKK
                        </p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <h4 class="font-medium opacity-70 uppercase">Active</h4>
                        <p class="isActive">
                            <?= $beer['beer_is_active'] ? 'Yes' : 'No' ?>
                        </p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <h4 class="font-medium opacity-70 uppercase">Tapwall no.</h4>
                        <p class="tapwallNo">
                            <?= $beer['beer_tapwall_no'] ? out($beer['beer_tapwall_no']) : '-' ?>
                        </p>
                    </div>
                    <div class="col-span-5 xl:col-span-6 grid grid-cols-12 gap-2">
                        <div class="col-span-12">
                            <h4 class="font-medium opacity-70 uppercase">Description</h4>
                            <p class="description">
                                <?= $beer['beer_description'] ? out($beer['beer_description']) : '-' ?>
                            </p>
                        </div>
                        <div class="col-span-10 md:col-span-4 text-sm">
                            <h4 class="font-medium opacity-70 uppercase">Created at</h4>
                            <p class="createdAt"><?= out(date('d/m/Y', intval($beer['beer_created_at']))) ?></p>
                        </div>
                        <div class="col-span-10 md:col-span-4 text-sm">
                            <h4 class="font-medium opacity-70 uppercase">Updated at</h4>
                            <p class="updatedAt">
                                <?= $beer['beer_updated_at'] ? out(date('d/m/Y', intval($beer['beer_updated_at']))) : '-' ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-span-3 xl:col-span-2 flex justify-end">
                        <img class="<?= $beer['beer_image'] ? '' : 'hidden' ?>" src="./public/images/uploads/<?= out($beer['beer_image']) ?>" alt="<?= out($beer['brewery_name']) ?> <?= out($beer['beer_name']) ?>" />
                    </div>
                </div>
            </article>

            <?php } ?>
        </section>

        <section id="createBeer" class="pt-12">
            <h2 class="mb-4 font-medium text-2xl">Create new beer</h2>
            <?php include_once __DIR__ . '/templates/form_create_beer.php'; ?>
        </section>
    </main>
</div>



<?php
include_once __DIR__ . '/templates/modal_update_user.php';
include_once __DIR__ . '/templates/modal_update_brewery.php';
include_once __DIR__ . '/templates/modal_update_beer.php';
include_once __DIR__ . '/templates/modal_delete_user.php';
include_once __DIR__ . '/templates/modal_delete_brewery.php';
include_once __DIR__ . '/templates/modal_delete_beer.php';
include_once __DIR__ . '/templates/footer.php';