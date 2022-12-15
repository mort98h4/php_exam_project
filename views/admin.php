<?php

$title = 'Admin';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';

if (!$validSession) _redirect('/');
if (!$admin) _redirect('/');
$users = _getUsers();
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
        <hr class="mt-8 opacity-50" />
        <section id="createUser" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">Create new user</h2>
            <?php include_once __DIR__ . '/templates/form_create_user.php'; ?>
        </section>
        <hr class="mt-12 opacity-50" />
        <section id="allBreweries" class="pt-12">
            <h2 class="text-2xl font-medium mb-4">All breweries</h2>
            <?php include_once __DIR__ . '/templates/all_breweries.php'; ?>
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