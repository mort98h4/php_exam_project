<?php
require_once __DIR__ . '/../../utils.php';
?>

<form class="w-full flex flex-wrap gap-4">
    <div class="form-control-full lg:form-control">
        <div class="relative w-full">
            <input class="dynamic-input" type="text" name="name" id="create_brewery_name" required minlength="<?= _STR_MIN_LEN ?>" maxlength="<?= _STR_MAX_LEN ?>" placeholder=" "/>
            <div class="label-container">
                <label class="dynamic-label" for="create_brewery_name">Name</label>
            </div>
        </div>
        <span class="hint mb-4">Please type a name between <?= _STR_MIN_LEN ?> and <?= _STR_MAX_LEN ?> characters.</span>
    </div>
    <div class="flex flex-wrap w-full gap-4 justify-center">
        <div class="error-container text-center w-full hidden">
            <span class="text-red-600"></span>
        </div>
        <?php if ($admin) { ?> 
        <button class="btn" type="submit" onclick="formValidation(postBrewery, '/admin')">Create brewery</button>
        <?php } else if ($editor) { ?> 
        <button class="btn" type="submit" onclick="formValidation(postBrewery, '/editor')">Create brewery</button>
        <?php } ?>
    </div>
</form>