<?php

$title = 'Home';
include_once __DIR__ . '/templates/header.php';
?>
<nav>
    <?php
    if (!$_SESSION) {
    ?>
    <button>Log in</button>
    <?php
    } else {
    ?>
    <button data-id="<?= out($_SESSION['user_id']) ?>" onclick="deleteSession()">Log out</button>
    <?php
    }
    ?>
</nav>
<h1>Anarkist</h1>
<section id="login_modal">
    <button onclick="">X</button>
    <form method="POST" action="/login">
        <div>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))' />
        </div>
        <div>
            <label for="password">Password</label>
            <!-- INSERT PASSWORD PATTERN -->
            <input type="password" id="password" name="password" required />
        </div>
        <button type="submit" onclick="formValidation(postSession)">Log in</button>
    </form>
</section>

<?php 
?>

<?php 
include_once __DIR__ . '/templates/footer.php';