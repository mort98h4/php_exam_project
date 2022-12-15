<?php 
$roles = _getRoles();
?>

<form class="w-full flex flex-wrap gap-4">
    <div class="form-control-full lg:form-control">
        <div class="relative w-full">
            <input class="dynamic-input" type="text" name="first_name" id="create_user_first_name" required minlength="2" maxlength="30" placeholder=" " />
            <div class="label-container">
                <label class="dynamic-label" for="create_user_first_name">First name</label>
            </div>
        </div>
        <span class="hint mb-4">Please type a first name between 2 and 30 characters.</span>
    </div>
    <div class="form-control-full lg:form-control">
        <div class="relative w-full">
        <input class="dynamic-input" type="text" name="last_name" id="create_user_last_name" required minlength="2" maxlength="30" placeholder=" " />
            <div class="label-container">
                <label class="dynamic-label" for="create_user_last_name">Last name</label>
            </div>
        </div>
        <span class="hint mb-4">Please type a last name between 2 and 30 characters.</span>
    </div>
    <div class="form-control-full">
        <div class="relative w-full">
            <input class="dynamic-input" type="email" name="email" id="create_user_email" required placeholder=" " pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))' />
            <div class="label-container">
                <label class="dynamic-label" for="create_user_email">E-mail</label>
            </div>
        </div>
        <span class="hint mb-4">Please type a valid e-mail address.</span>
    </div>
    <div class="form-control-full lg:form-control">
        <div class="relative w-full">
            <input class="dynamic-input" type="password" name="password" id="create_user_password" required placeholder=" " pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
            <div class="label-container">
                <label class="dynamic-label" for="create_user_password">Password</label>
            </div>
        </div>
        <span class="hint mb-4">Please type a password containing 1 uppercase letter, 1 lowercase letter, 1 digit, and 1 special character.</span>
    </div>
    <div class="form-control-full lg:form-control">
        <div class="relative w-full">
            <input class="dynamic-input" type="password" name="confirm_password" id="create_user_confirm_password" placeholder=" " required pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
            <div class="label-container">
                <label class="dynamic-label" for="create_user_confirm_password">Confirm password</label>
            </div>
        </div>
        <span class="hint mb-4">Please confirm your chosen password.</span>
    </div>
    <?php if ($admin) { ?>
    <div class="form-control-full lg:form-control">
        <div class="relative w-full">
            <select class="dynamic-select valid" id="create_user_role" name="role" required>
                <?php foreach($roles as $role) { ?>
                <option value="<?= out($role['role_id']) ?>">
                    <?= out($role['role_name']) ?>
                </option>
                <?php } ?>
            </select>
            <div class="label-container">
                <label class="dynamic-label" for="create_user_role">Active</label>
            </div>
        </div>
        <span class="hint">Please select a role.</span>
    </div>
    <?php } ?>
    <div class="flex flex-wrap w-full gap-4 justify-center">
        <div class="error-container text-center w-full hidden">
            <span class="text-red-600"></span>
        </div>
        <?php if ($admin) { ?>
        <button class="btn" type="submit" onclick="formValidation(postUser, '/admin')">Create user</button>
        <?php } else { ?>
        <button class="btn" type="submit" onclick="formValidation(postUser, '/')">Create user</button>
        <?php } ?>
    </div>
</form>