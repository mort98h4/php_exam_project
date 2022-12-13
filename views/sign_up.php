<?php

$title = 'Sign up';
$admin = false;

require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/templates/nav.php';
?>

<main class="container mt-12 mx-auto p-4 grid grid-cols-12 gap-4">
    <header class="col-span-12 sm:col-start-3 sm:col-end-11 md:col-start-4 md:col-end-10">
        <h1 class="text-3xl font-medium">Sign up</h1>
    </header>
    <div class="col-span-12 sm:col-start-3 sm:col-end-11 md:col-start-4 md:col-end-10">
        <?php include_once __DIR__ . '/templates/form_create_user.php' ?>
    </div>
    
</main>

<?php
require_once __DIR__ . '/templates/modal_login.php';
require_once __DIR__ . '/templates/footer.php';