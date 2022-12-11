<section id="delete_brewery_modal" class="modal">
    <div class="h-full w-full absolute top-0 left-0 z-10" onclick="toggleDeleteModal()" data-target="#delete_brewery_modal"></div>
    <article class="relative z-20 w-full sm:w-1/2 xl:w-1/3 m-4 p-4 bg-black flex flex-wrap justify-center border-2 border-white shadow-2xl">
        <header class="w-full flex justify-between items-center mb-4">
            <h2 class="text-2xl font-medium">Delete brewery</h2>
            <button onclick="toggleDeleteModal()" data-target="#delete_brewery_modal" class="btn-icon">
                <i class="fa-sharp fa-solid fa-xmark pointer-events-none text-2xl"></i>
            </button>  
        </header>
        <p class="text-center mb-4">Are you sure you want to delete this brewery?</p>
        <div class="w-3/5 flex justify-center">
            <form class="w-full flex gap-4 flex-wrap justify-center">
                <input type="hidden" name="id" value="" />
                <div class="form-control-full">
                    <div class="relative w-full">
                        <input class="dynamic-input" placeholder=" " type="text" id="confirm_brewery_delete" name="confirm" required pattern="^[D]{1}[E]{1}[L]{1}[E]{1}[T]{1}[E]{1}" />
                        <div class="label-container">
                            <label for="confirm_brewery_delete" class="dynamic-label">Confirm deletion</label>
                        </div>
                    </div>
                    <span class="hint">Please type 'DELETE' in all caps.</span>
                </div>
                <div class="error-container hidden">
                    <span class="text-red-600"></span>
                </div>
                <button class="btn my-4" type="submit" onclick="formValidation(deleteBrewery)">Delete</button>
            </form>
        </div>
    </arcicle>
</section>