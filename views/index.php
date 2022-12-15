<?php

$title = 'Home';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';
?>

<main class=" mx-auto h-screen p-4 overflow-hidden">
    <section class="w-100 mx-auto flex justify-center content-center h-full relative max-w-screen-xl">
        <div class="self-center">
            <img class="self-center animate" src="./public/images/anarkist_logo_light.png" alt="Anarkist logo" />
        </div>
        <div class="h-full absolute z-10 flex gap-2">
            <?php if (!$validSession) { ?>
        
            <button onclick="toggleModal()" data-target="#login_modal" class="btn">Log in</button>
            <a href="/signup" class="btn">Sign up</a>
        
            <?php } else { ?>
            
            <a href="/tapwall" class="btn">Go to Tapwall</a>

            <?php } ?>
        </div>
        <div class="absolute bottom-0 right-[-15%] frontpage-image max-w-[40%]">
            <img src="/public/images/Fizzy-Lime-Fusion-e1667392143872-768x454.webp" />
        </div>
    </section>
</main>

<?php 
include_once __DIR__ . '/templates/modal_login.php';
include_once __DIR__ . '/templates/footer.php';