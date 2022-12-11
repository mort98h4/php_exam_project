<?php

$title = 'Sign up';
$admin = false;

require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/templates/nav.php';
?>

<main class="container mt-12 mx-auto p-4 flex justify-center flex-wrap md:flex-col md:items-center">
    <header class="w-full md:w-1/2 mb-4">
        <h1 class="text-3xl font-medium">Sign up</h1>
    </header>
    <?php include_once __DIR__ . '/templates/form_create_user.php' ?>
</main>

<?php
require_once __DIR__ . '/templates/modal_login.php';
require_once __DIR__ . '/templates/footer.php';