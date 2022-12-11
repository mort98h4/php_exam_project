<?php 
$roles = _getRoles(); 
?>

<form class="w-full flex flex-wrap gap-4">
    <input type="hidden" name="user_id" value="" />
    <div class="form-control-full">
        <div class="relative w-full">
            <input class="dynamic-input" type="text" name="first_name" id="first_name" required minlength="2" maxlength="30" placeholder=" " />
            <div class="label-container">
                <label class="dynamic-label" for="first_name">First name</label>
            </div>
        </div>
        <span class="hint mb-4">Please type a first name between 2 and 30 characters.</span>
    </div>
    <div class="form-control-full">
        <div class="relative w-full">
            <input class="dynamic-input" type="text" name="last_name" id="last_name" required minlength="2" maxlength="30" placeholder=" " />
            <div class="label-container">
                <label class="dynamic-label" for="last_name">Last name</label>
            </div>
        </div>
        <span class="hint mb-4">Please type a last name between 2 and 30 characters.</span>
    </div>
    <div class="form-control-full">
        <div class="relative w-full">
            <input class="dynamic-input" type="email" name="email" id="email" required placeholder=" " pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))' />
            <div class="label-container">
                <label class="dynamic-label" for="email">E-mail</label>
            </div>
        </div>
        <span class="hint mb-4">Please type a valid e-mail address.</span>
    </div>
    <div class="form-control-full">
        <div class="relative w-full">
            <select class="dynamic-select valid" id="user_role_id" name="role_id" required>
                <?php foreach($roles as $role) { ?>
                <option value="<?= out($role['role_id']) ?>">
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
    <div class="flex flex-wrap w-full gap-4 justify-center">
        <div class="error-container text-center w-full hidden">
            <span class="text-red-600"></span>
        </div>
        <button class="btn" type="submit" onclick="formValidation(updateUser)">Update user</button>
    </div>
</form>