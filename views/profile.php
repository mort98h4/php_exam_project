<?php
$title = 'Profile';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';

if (!$validSession) _redirect('/');
if ($_SESSION['user_id'] !== $user_id) _redirect('/404');
$roles = _getRoles();
?>

<main class="container mt-12 mx-auto p-4 grid grid-cols-12 gap-4">
    <header class="col-span-12 sm:col-start-3 sm:col-end-11 md:col-start-4 md:col-end-10">
        <h1 class="text-3xl font-medium ">Profile</h1>
    </header>
    <section class="col-span-12 sm:col-start-3 sm:col-end-11 md:col-start-4 md:col-end-10">
        <h2 class="text-2xl font-medium mb-4">Update profile</h2>
        <form class="w-full flex flex-wrap gap-4">
            <input type="hidden" name="user_id" value="<?= out($_SESSION['user_id']) ?>" />
            <div class="form-control-full lg:form-control">
                <div class="relative w-full">
                    <input class="dynamic-input" type="text" name="first_name" id="first_name" value="<?= out($_SESSION['user_first_name']) ?>" required minlength="2" maxlength="30" placeholder=" " />
                    <div class="label-container">
                        <label class="dynamic-label" for="first_name">First name</label>
                    </div>
                </div>
                <span class="hint mb-4">Please type a first name between 2 and 30 characters.</span>
            </div>
            <div class="form-control-full lg:form-control">
                <div class="relative w-full">
                    <input class="dynamic-input" type="text" name="last_name" id="last_name" value="<?= out($_SESSION['user_last_name']) ?>" required minlength="2" maxlength="30" placeholder=" " />
                    <div class="label-container">
                        <label class="dynamic-label" for="last_name">Last name</label>
                    </div>
                </div>
                <span class="hint mb-4">Please type a last name between 2 and 30 characters.</span>
            </div>
            <div class="form-control-full <?php if ($admin) { ?>lg:form-control<?php } ?>">
                <div class="relative w-full">
                    <input class="dynamic-input" type="email" name="email" id="email" required placeholder=" " value="<?= out($_SESSION['user_email']) ?>" pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))' />
                    <div class="label-container">
                        <label class="dynamic-label" for="email">E-mail</label>
                    </div>
                </div>
                <span class="hint mb-4">Please type a valid e-mail address.</span>
            </div>
            <?php if ($admin) { ?> 
            <div class="form-control-full lg:form-control">
                <div class="relative w-full">
                    <select class="dynamic-select valid" id="user_role_id" name="role_id" value="<? out($_SESSION['role_id']) ?>" required>
                        <?php foreach($roles as $role) { ?>
                        <option 
                            value="<?= out($role['role_id']) ?>"
                            <?php if ($_SESSION['user_role'] === $role['role_id']) { ?>
                            selected
                            <?php } ?>
                        >
                            <?= out($role['role_name']) ?>
                        </option>
                        <?php } ?>
                    </select>
                    <div class="label-container">
                        <label class="dynamic-label" for="user_role_id">Role</label>
                    </div>
                </div>
                <span class="hint">Please select a role.</span>
            </div>
            <?php } ?>
            <div class="flex flex-wrap w-full gap-4 justify-center">
                <div class="error-container text-center w-full hidden">
                    <span class="text-red-600"></span>
                </div>
                <button class="btn" type="submit" onclick="formValidation(updateUser, '/profile/<?= out($_SESSION['user_id']) ?>')">Update user</button>
            </div>
        </form>
    </section>

    <section class="col-span-12 sm:col-start-3 sm:col-end-11 md:col-start-4 md:col-end-10">
        <h2 class="text-2xl font-medium mb-4">Update password</h2>
        <form class="w-full flex gap-4 flex-wrap">
            <input type="hidden" name="id" value="<?= out($_SESSION['user_id']) ?>" />
            <div class="form-control-full">
                <div class="relative w-full">
                    <input class="dynamic-input" type="password" name="password" id="user_password" required placeholder=" " pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
                    <div class="label-container">
                        <label for="user_password" class="dynamic-label">Password</label>
                    </div>
                </div>
                <span class="hint">Please type your password.</span>
            </div>
            <div class="form-control-full lg:form-control">
                <div class="relative w-full">
                    <input class="dynamic-input" type="password" name="new_password" id="new_password" required placeholder=" " pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
                    <div class="label-container">
                        <label for="new_password" class="dynamic-label">New password</label>
                    </div>
                </div>
                <span class="hint">Please type a password containing 1 uppercase letter, 1 lowercase letter, 1 digit, and 1 special character.</span>
            </div>
            <div class="form-control-full lg:form-control">
                <div class="relative w-full">
                <input class="dynamic-input" type="password" name="confirm_new_password" id="confirm_new_password" required placeholder=" " pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
                    <div class="label-container">
                        <label for="confirm_new_password" class="dynamic-label">Confirm new password</label>
                    </div>
                </div>
                <span class="hint">Please confirm your new password.</span>
            </div>
            <div class="flex flex-wrap w-full gap-4 justify-center">
                <div class="error-container text-center w-full hidden">
                    <span class="text-red-600"></span>
                    <span class="text-green-600"></span>
                </div>
                <button class="btn my-4" type="submit" onclick="formValidation(updatePassword)">Update password</button>
            </div>
        </form>
    </section>

    <section class="col-span-12 sm:col-start-3 sm:col-end-11 md:col-start-4 md:col-end-10">
        <h2 class="text-2xl font-medium mb-4">Delete profile</h2>
        <form class="w-full flex gap-4 flex-wrap justify-center">
            <input type="hidden" name="id" value="<?= out($_SESSION['user_id']) ?>" />
            <div class="form-control-full">
                <div class="relative w-full">
                    <input class="dynamic-input" placeholder=" " type="text" id="confirm_user_delete" name="confirm" required pattern="^[D]{1}[E]{1}[L]{1}[E]{1}[T]{1}[E]{1}" />
                    <div class="label-container">
                        <label for="confirm_user_delete" class="dynamic-label">Confirm deletion</label>
                    </div>
                </div>
                <span class="hint">Please type 'DELETE' in all caps.</span>
            </div>
            <div class="error-container hidden">
                <span class="text-red-600"></span>
            </div>
            <button class="btn my-4" type="submit" onclick="formValidation(deleteUser, '/profile/<?= out($_SESSION['user_id']) ?>')">Delete user</button>
        </form>
    </section>
</main>

<?php
include_once __DIR__ . '/templates/footer.php';