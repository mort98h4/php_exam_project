<?php

$title = 'Sign up';

require_once __DIR__ . '/templates/header.php';
?>

<form method="POST" action="/user">
    <div>
        <label for="first_name">First name</label>
        <input type="text" name="first_name" id="first_name" required minlength="2" maxlength="30" />
        <span class="hint">Please type a first name between 2 and 30 characters.</span>
    </div>
    <div>
        <label for="last_name">Last name</label>
        <input type="text" name="last_name" id="last_name" required minlength="2" maxlength="30" />
        <span class="hint">Please type a last name between 2 and 30 characters.</span>
    </div>
    <div>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))' />
        <span class="hint">Please type a valid e-mail address.</span>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
        <span class="hint">Please type a password containing 1 uppercase letter, 1 lowercase letter, 1 digit, and 1 special character.</span>
    </div>
    <div>
        <label for="confirm_password">Confirm password</label>
        <input type="password" name="confirm_password" id="confirm_password" required pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
        <span class="hint">Please confirm your chosen password.</span>
    </div>
    <button type="submit" onclick="formValidation(postUser)">Create user</button>
</form>

<?php
require_once __DIR__ . '/templates/footer.php';