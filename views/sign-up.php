<?php

$title = 'Sign up';

require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/templates/nav.php';
?>

<main class="container mt-12 mx-auto p-4 flex justify-center flex-wrap">
    <header class="w-full inline-flex justify-center mb-4">
        <h1 class="w-full sm:w-3/5 lg:w-2/5 text-3xl font-medium">Sign up</h1>
    </header>
    <form method="POST" action="/user" class="w-full sm:w-3/5 lg:w-2/5 flex flex-col items-center self-start">
        <div class="relative w-full">
            <input class="dynamic-input" type="text" name="first_name" id="first_name" required minlength="2" maxlength="30" placeholder=" " />
            <div class="label-container">
                <label class="dynamic-label" for="first_name">First name</label>
            </div>
        </div>
        <span class="hint">Please type a first name between 2 and 30 characters.</span>
        <div class="relative w-full">
            <input class="dynamic-input" type="text" name="last_name" id="last_name" required minlength="2" maxlength="30" placeholder=" " />
            <div class="label-container">
                <label class="dynamic-label" for="last_name">Last name</label>
            </div>
        </div>
        <span class="hint">Please type a last name between 2 and 30 characters.</span>
        <div class="relative w-full">
            <input class="dynamic-input" type="email" name="email" id="email" required placeholder=" " pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))' />
            <div class="label-container">
                <label class="dynamic-label" for="email">E-mail</label>
            </div>
        </div>
        <span class="hint">Please type a valid e-mail address.</span>
        <div class="relative w-full">
            <input class="dynamic-input" type="password" name="password" id="password" required placeholder=" " pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
            <div class="label-container">
                <label class="dynamic-label" for="password">Password</label>
            </div>
        </div>
        <span class="hint">Please type a password containing 1 uppercase letter, 1 lowercase letter, 1 digit, and 1 special character.</span>
        <div class="relative w-full">
            <input class="dynamic-input" type="password" name="confirm_password" id="confirm_password" placeholder=" " required pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
            <div class="label-container">
                <label class="dynamic-label" for="confirm_password">Confirm password</label>
            </div>
        </div>
        <span class="hint">Please confirm your chosen password.</span>
        <button class="btn" type="submit" onclick="formValidation(postUser)">Create user</button>
    </form>
</main>

<?php
require_once __DIR__ . '/templates/login_modal.php';
require_once __DIR__ . '/templates/footer.php';