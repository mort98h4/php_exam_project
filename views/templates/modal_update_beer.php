<?php
include_once __DIR__ . '/../../utils.php';
$breweries = _getBreweries(true);
?>

<section id="update_beer_modal" class="modal">
    <div class="h-full w-full absolute top-0 left-0 z-10" onclick="toggleUpdateModal()" data-target="#update_beer_modal"></div>
    <div class="relative z-20 w-full sm:w-3/4 lg:w-2/4 m-4 p-4 bg-black flex flex-wrap justify-between border-2 border-white shadow-2xl">
        <header class="flex items-center justify-between w-full mb-4">
            <h3 class="text-xl font-medium">Update beer</h3>
            <button onclick="toggleUpdateModal()" data-target="#update_beer_modal" class="btn-icon">
                <i class="fa-sharp fa-solid fa-xmark pointer-events-none text-2xl"></i>
            </button>
        </header>
        <form class="w-full flex flex-wrap gap-4">
            <input type="hidden" name="beer_id" value="" />
            <input type="hidden" name="created_by" value="" />
            <input type="hidden" name="created_at" value="" />
            <input type="hidden" name="updated_at" value="" />
            <div class="flex flex-wrap w-full gap-4">
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <select onchange="toggleLabel()" class="dynamic-select" id="beer_brewery_id" name="brewery_id" required>
                            <option value=""></option>
                            <?php foreach($breweries as $brewery) { ?>
                            <option value="<?= out($brewery['brewery_id']) ?>">
                                <?= out($brewery['brewery_name']) ?>
                            </option>
                            <?php } ?>
                        </select>
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_brewery_id">Brewery</label>
                        </div>
                    </div>
                    <span class="hint">Please select a brewery.</span>
                </div>
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <input class="dynamic-input" type="text" id="beer_name" name="name" placeholder=" " required minlength="<?= _STR_MIN_LEN ?>" maxlength="<?= _STR_MAX_LEN ?>"/>
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_name">Name</label>
                        </div>
                    </div>
                    <span class="hint">Please type a name between 2 and 30 characters.</span>
                </div>
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <input class="dynamic-input" type="text" id="beer_style" name="style" placeholder=" " required minlength="<?= _STR_MIN_LEN ?>" maxlength="<?= _STR_MAX_LEN ?>"/>
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_style">Style</label>
                        </div>
                    </div>
                    <span class="hint">Please type a style between 2 and 30 characters.</span>
                </div>
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <input class="dynamic-input" type="number" id="beer_volume" name="volume" placeholder=" " required min="0" step=".1" />
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_volume">Volume</label>
                        </div>
                    </div>
                    <span class="hint">Please type a value of min. 0.</span>
                </div>
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <input class="dynamic-input" type="number" id="beer_ibu" name="ibu" placeholder=" " required min="0" max="182" />
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_ibu">IBU</label>
                        </div>
                    </div>
                    <span class="hint">Please type a value of min. 0 and max. 182.</span>
                </div>
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <input class="dynamic-input" type="number" id="beer_ebc" name="ebc" placeholder=" " required min="0" max="150" />
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_ebc">EBC</label>
                        </div>
                    </div>
                    <span class="hint">Please type a value of min. 0 and max. 150.</span>
                </div>
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <select class="dynamic-select valid" id="beer_is_active" name="is_active" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_is_active">Active</label>
                        </div>
                    </div>
                    <span class="hint">Determines whether the beer should be displayed on the tapwall.</span>
                </div>
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <input class="dynamic-input" type="number" id="beer_tapwall_no" name="tapwall_no" placeholder=" " required min="0" max="29" />
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_tapwall_no">Tapwall no.</label>
                        </div>
                    </div>
                    <span class="hint">Please type a value of min. 0 and max. 29.</span>
                </div>
                <div class="form-control-full md:form-control">
                    <div class="relative w-full">
                        <input class="dynamic-input" type="number" id="beer_price" name="price" placeholder=" " required min="0" step=".1" />
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_price">Price</label>
                        </div>
                    </div>
                    <span class="hint">Please typa a value of min. 0.</span>
                </div>
                <div class="form-control-full">
                    <div class="relative w-full">
                        <textarea class="dynamic-textarea" id="beer_description" name="description" placeholder=" "></textarea>
                        <div class="label-container">
                            <label class="dynamic-label" for="beer_description">Description</label>
                        </div>
                    </div>
                    <span class="hint"></span>
                </div>
                <div class="form-control-66">
                    <div class="relative w-full">
                        <input type="hidden" id="beer_image" name="beer_image" data-input-id="#beer_image_update" /> 
                        <label for="beer_image_update" class="image-label">
                            <i class="fa-sharp fa-solid fa-image"></i>
                            <span>Upload photo</span>
                        </label>
                        <input onchange="addPreviewImage()" class="" type="file" id="beer_image_update" name="image" accept="image/png, image/jpg, image/jpeg" />
                    </div>
                    <span class="hint">Only .png, .jpg, .jpeg allowed.</span>
                </div>
                <div class="form-control-33">
                    <div class="preview hidden relative" data-input-id="#beer_image_update">
                        <img src="" />
                        <button type="button" role="button" onclick="removePreviewImage()" data-input-id="#beer_image_update" class="btn-icon absolute top-0 right-0 cursor-pointer">
                            <i class="fa-sharp fa-solid fa-xmark pointer-events-none text-2xl"></i>
                        </button>
                    </div>
                </div>
                <div class="w-full flex flex-wrap justify-center gap-4">
                    <div class="error-container text-center w-full hidden">
                        <span class="text-red-600"></span>
                    </div>
                    <button class="btn" type="submit" onclick="formValidation(updateBeer)">Update beer</button>
                </div>
            </div>
        </form>
    </div>
</section>