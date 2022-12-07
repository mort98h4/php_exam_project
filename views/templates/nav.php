<nav class="fixed top-0 left-0 w-full z-50 backdrop-blur-sm">
    <div class="container mx-auto px-4 py-2 grid grid-rows-1 grid-cols-12">
        <a href="/" class="col-span-3 sm:col-span-2 xl:col-span-1">
            <img class="" src="./public/images/anarkist_logo_light.png" alt="Anarkist logo" />
        </a>
        <div class="menu col-span-6 sm:col-span-8 xl:col-span-10 flex justify-center items-center gap-4">
            <?php
            if (!$_SESSION) {
            ?>
            <a class="nav-link" href="/sign-up">Sign up</a>
            <a class="nav-link" onclick="toggleModal()" data-target="#login_modal">Log in</a>
            <?php
            } else {
            ?>
            <a class="nav-link" data-id="<?= out($_SESSION['user_id']) ?>" onclick="deleteSession()">Log out</a>
            <?php
            }
            ?>
        </div>
        <div class="col-span-3 sm:col-span-2 xl:col-span-1 flex justify-end items-center">
            <button onclick="toggleBurger()" class="burger">
                <i class="fa-sharp fa-solid fa-bars"></i>
                <i class="fa-sharp fa-solid fa-xmark "></i>
            </button>
        </div>
    </div>
</nav>