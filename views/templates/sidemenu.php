<aside id="side_menu" class="sidemenu pt-4">
    <div class="w-full flex justify-end items-center sm:hidden">
        <button class="burger" data-target="#side_menu" onclick="toggleBurger()">
            <i class="fa-solid fa-ellipsis pointer-events-none"></i>
            <i class="fa-sharp fa-solid fa-xmark "></i>
        </button>
    </div>
    <nav>
        <?php if ($admin) { ?>
        <div class="mb-4">
            <a href="#allUsers" class="nav-link text-lg">Users</a>
            <ul class="pl-4">
                <li>
                    <a href="#allUsers" class="nav-link">All users</a>
                </li>
                <li>
                    <a href="#createUser" class="nav-link">Create new user</a>
                </li>
            </ul>
        </div>
        <?php } ?>
        <div class="mb-4">
            <a class="nav-link text-lg">Breweries</a>
            <ul class="pl-4">
                <li>
                    <a href="#allBreweries" class="nav-link">All breweries</a>
                </li>
                <li>
                    <a href="#createBrewery" class="nav-link">Create new brewery</a>
                </li>
            </ul>
        </div>
        <div class="mb-4">
            <a class="nav-link text-lg">Beers</a>
            <ul class="pl-4">
                <li>
                    <a href="#allBeers" class="nav-link">All beers</a>
                </li>
                <li>
                    <a href="#createBeer" class="nav-link">Create new beer</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="hidden sm:flex items-center">
        <img src="/public/images/Mighty-Mild-Ale-illustration-uden-baggrund-e1667389080254-1536x954.png" />
    </div>
</aside>