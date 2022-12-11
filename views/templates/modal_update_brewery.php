<?php 
require_once __DIR__ . '/../../utils.php';
?>

<section id="update_brewery_modal" class="modal">
    <div class="h-full w-full absolute top-0 left-0 z-10" onclick="toggleUpdateModal()" data-target="#update_brewery_modal"></div>
    <div class="relative z-20 w-full sm:w-1/2 xl:w-1/3 m-4 p-4 bg-black flex flex-wrap justify-between border-2 border-white shadow-2xl">
        <header class="flex items-center justify-between w-full mb-4">
            <h3 class="text-xl font-medium">Update brewery</h3>
            <button onclick="toggleUpdateModal()" data-target="#update_brewery_modal" class="btn-icon">
                <i class="fa-sharp fa-solid fa-xmark pointer-events-none text-2xl"></i>
            </button>
        </header>
        <form class="w-full flex flex-wrap gap-4">
            <input type="hidden" name="brewery_id" value="" />
            <div class="form-control-full">
                <div class="relative w-full">
                    <input class="dynamic-input" type="text" name="name" id="brewery_name" required minlength="<?= _STR_MIN_LEN ?>" maxlength="<?= _STR_MAX_LEN ?>" placeholder=" " />
                    <div class="label-container">
                        <label class="dynamic-label" for="brewery_name">Name</label>
                    </div>
                </div>
                <span class="hint mb-4">Please type a name between <?= _STR_MIN_LEN ?> and <?= _STR_MAX_LEN ?> characters.</span>
            </div>
            <div class="flex flex-wrap w-full gap-4 justify-center">
                <div class="error-container text-center w-full hidden">
                    <span class="text-red-600"></span>
                </div>
                <button class="btn" type="submit" onclick="formValidation(updateBrewery)">Update brewery</button>
            </div>
        </form>
    </div>
</section>