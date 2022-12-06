<?php

$title = 'Home';
include_once __DIR__ . '/templates/header.php';
?>
<nav>
    <?php
    if (!$_SESSION) {
    ?>
    <button>Log in</button>
    <a href="/sign-up">Sign up</a>
    <?php
    } else {
    ?>
    <button data-id="<?= out($_SESSION['user_id']) ?>" onclick="deleteSession()">Log out</button>
    <?php
    }
    ?>
</nav>
<main class="container mx-auto h-screen p-4">
    <section class="w-100 flex justify-center content-center h-full">
        <div class="self-center">
            <img class="self-center" src="./public/images/anarkist_logo_light.png" alt="Anarkist logo" />
        </div>
        <div class="h-full absolute flex gap-2">
            <button onclick="toggleModal()" data-target="#login_modal" class="btn">Log in</button>
            <a href="/sign-up" class="btn">Sign up</a>
        </div>
    </section>
</main>
<section id="login_modal" class="modal">
    <div class="h-full w-full absolute top-0 left-0" onclick="toggleModal()" data-target="#login_modal"></div>
    <div class="w-1/3 p-4 bg-black flex flex-col justify-between">
        <div class="w-full flex justify-between items-center mb-4">
            <h2 class="text-2xl font-medium">Log in</h2>
            <button onclick="toggleModal()" data-target="#login_modal">X</button>
        </div>
        <form method="POST" action="/login" class="w-full flex justify-center">
            <div class="h-full w-3/5 flex flex-wrap flex-col items-center">
                <div class="relative w-full mb-4">
                    <input class="dynamic-input" placeholder=" " type="email" id="email" name="email" required pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))' />
                    <div class="label-container">
                        <label for="email" class="dynamic-label">E-mail</label>
                    </div>
                </div>
                <div class="relative w-full mb-4">
                    <!-- INSERT PASSWORD PATTERN -->
                    <input class="dynamic-input" placeholder=" " type="password" id="password" name="password" required />
                    <div class="label-container">
                        <label for="password" class="dynamic-label">Password</label>
                    </div>
                </div>
                <div class="">
                    <span class=""></span>
                </div>
                <button class="btn mt-4" type="submit" onclick="formValidation(postSession)">Log in</button>
            </div>
        </form>
    </div>
</section>

<?php 
?>

<?php 
include_once __DIR__ . '/templates/footer.php';