<?php

$title = 'Home';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';
?>

<main class="container mx-auto h-screen p-4">
    <section class="w-100 flex justify-center content-center h-full relative">
        <div class="self-center">
            <img class="self-center" src="./public/images/anarkist_logo_light.png" alt="Anarkist logo" />
        </div>
        <?php if (!$validSession) { ?>
        <div class="h-full absolute flex gap-2">
            <button onclick="toggleModal()" data-target="#login_modal" class="btn">Log in</button>
            <a href="/sign-up" class="btn">Sign up</a>
        </div>
        <?php } ?>
    </section>
</main>

<?php 
include_once __DIR__ . '/templates/login_modal.php';
include_once __DIR__ . '/templates/footer.php';