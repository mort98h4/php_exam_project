<section id="login_modal" class="modal">
    <div class="h-full w-full absolute top-0 left-0 z-10" onclick="toggleModal()" data-target="#login_modal"></div>
    <div class="relative z-20 w-full sm:w-1/2 xl:w-1/3 m-4 p-4 bg-black flex flex-col justify-between border-2 border-white shadow-2xl">
        <div class="w-full flex justify-between items-center mb-4">
            <h2 class="text-2xl font-medium">Log in</h2>
            <button onclick="toggleModal()" data-target="#login_modal" class="btn-close">
                <i class="fa-sharp fa-solid fa-xmark pointer-events-none text-2xl"></i>
            </button>
        </div>
        <form method="POST" action="/login" class="w-full flex justify-center">
            <div class="w-3/5 flex gap-4 flex-wrap justify-center">
                <div class="relative w-full">
                    <input class="dynamic-input" placeholder=" " type="email" id="email" name="email" required pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))' />
                    <div class="label-container">
                        <label for="email" class="dynamic-label">E-mail</label>
                    </div>
                </div>
                <div class="relative w-full">
                    <input class="dynamic-input" placeholder=" " type="password" id="password" name="password" required  pattern='^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}' />
                    <div class="label-container">
                        <label for="password" class="dynamic-label">Password</label>
                    </div>
                </div>
                <div class="error-container hidden">
                    <span class="text-red-600"></span>
                </div>
                <button class="btn my-4" type="submit" onclick="formValidation(postSession)">Log in</button>
            </div>
        </form>
        <hr class="opacity-50 mb-2" />
        <div class="w-full text-center mb-4">
            <p class="mb-2">Don't have an account?</p>
            <a href="/sign-up" class="nav-link text-xl">sign up</a>
        </div>
    </div>
</section>