<section id="update_user_modal" class="modal">
    <div class="h-full w-full absolute top-0 left-0 z-10" onclick="toggleUpdateModal()" data-target="#update_user_modal"></div>
    <div class="relative z-20 w-full sm:w-1/2 xl:w-1/3 m-4 p-4 bg-black flex flex-wrap justify-between border-2 border-white shadow-2xl">
        <header class="flex items-center justify-between w-full mb-4">
            <h3 class="text-xl font-medium">Update user</h3>
            <button onclick="toggleUpdateModal()" data-target="#update_user_modal" class="btn-close">
                <i class="fa-sharp fa-solid fa-xmark pointer-events-none text-2xl"></i>
            </button>
        </header>
        <?php include_once __DIR__ . '/form_update_user.php'; ?>
    </div>
</section>