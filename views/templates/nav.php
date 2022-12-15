<?php 
include_once __DIR__ . '/../../utils.php';
$validSession = _validateSession($_SESSION);
if ($validSession) {
    $admin = $_SESSION['user_role'] === '1' ? true : false;
    $editor = $_SESSION['user_role'] === '2' ? true : false; 
}

?>

<nav class="fixed top-0 left-0 w-full z-50 backdrop-blur-sm h-[50px]">
    <div class="container mx-auto px-4 py-2 grid grid-rows-1 grid-cols-12 items-center">
        <a href="/" class="col-span-6 md:col-span-2 md:col-start-1 md:col-end-3 xl:col-end-2 logo">
            <img class="" src="/public/images/anarkist_logo_light.png" alt="Anarkist logo" />
        </a>
        <div id="main_menu" class="menu w-full absolute md:relative overflow-x-hidden mx-[-1rem] md:mx-0 row-span-1 row-start-2 col-span-12 md:col-start-3 md:col-end-11 md:row-start-1 xl:col-start-2 xl:col-end-12 flex justify-center items-center gap-4 h-full">
            <a class="nav-link" href="/tapwall">Tapwall</a>
            <?php if ($validSession && $admin) { ?>
            <a class="nav-link" href="/admin">Admin</a>
            <?php } ?>
            <?php if ($validSession && $editor) { ?>
            <a class="nav-link" href="/editor">Editor</a>
            <?php } ?>
            <?php if (!$validSession) { ?>
            <a class="nav-link" href="/signup">Sign up</a>
            <a class="nav-link" onclick="toggleModal()" data-target="#login_modal">Log in</a>
            <?php } else { ?>
            <a class="nav-link" href="/profile/<?= out($_SESSION['user_id']) ?>">Profile</a>
            <a class="nav-link" data-id="<?= out($_SESSION['user_id']) ?>" onclick="deleteSession()">Log out</a>
            <?php } ?>
        </div>
        <div class="col-span-6 md:col-span-2 md:col-start-11 md:col-end-13 xl:col-start-12 xl:col-end-13 flex justify-end items-center">
            <button onclick="toggleBurger()" class="burger" data-target="#main_menu">
                <i class="fa-sharp fa-solid fa-bars"></i>
                <i class="fa-sharp fa-solid fa-xmark "></i>
            </button>
        </div>
    </div>
</nav>