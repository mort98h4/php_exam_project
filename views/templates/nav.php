<nav>
<?php
if (!$_SESSION) {
?>
<button onclick="toggleModal()" data-target="#login_modal">Log in</button>
<a href="/sign-up">Sign up</a>
<?php
} else {
?>
<button data-id="<?= out($_SESSION['user_id']) ?>" onclick="deleteSession()">Log out</button>
<?php
}
?>
</nav>