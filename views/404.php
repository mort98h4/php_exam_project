<?php

$title = '404';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';
?>

<main class="container mx-auto h-screen p-4 overflow-hidden relative">
    <section class="w-full pt-12 lg:p-0 flex lg:justify-center flex-col items-center h-full">
        <h1 class="text-3xl font-medium mb-2">404 - Page not found.</h1>
        <p class="mb-4">The page you are looking for does not seem to exist.</p>
        <a href="/" class="nav-link">Go back to the frontpage?</a>
    </section>
    <div class="absolute w-full bottom-0 right-0 max-w-[450px]">
        <img src="/public/images/Crisp-N-Cold-e1667393115584.png" />
    </div>
</main>

<?php
include_once __DIR__ . '/templates/modal_login.php';
include_once __DIR__ . '/templates/footer.php';