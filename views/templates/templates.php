<template id="breweryTmp">
    <article id="" class="brewery">
        <header class="flex items-center justify-between">
            <h3 class="text-xl font-medium mb-2"></h3>
            <div>
                <button class="btn-icon mr-2" onclick="toggleUpdateModal()" data-target="#update_brewery_modal" data-table="breweries" data-id="<?= out($brewery['brewery_id']) ?>" >
                    <i class="fa-sharp fa-solid fa-pen-to-square pointer-events-none"></i>
                </button>
                <button class="btn-icon text-red-600" onclick="toggleDeleteModal()" data-target="#delete_brewery_modal" data-id="<?= out($brewery['brewery_id']) ?>">
                    <i class="fa-sharp fa-solid fa-trash pointer-events-none"></i>
                </button>
            </div>
        </header>
    </article>
</template>

<template id="beerTmp">
    <article id="" class="beer">
        <header class="flex items-center justify-between">
            <h3 class="text-xl font-medium mb-2"></h3>
            <div>
                <button class="btn-icon mr-2" onclick="toggleUpdateModal()" data-target="#update_beer_modal" data-table="beers" data-id="">
                    <i class="fa-sharp fa-solid fa-pen-to-square pointer-events-none"></i>
                </button>
                <button class="btn-icon text-red-600" onclick="toggleDeleteModal()" data-target="#delete_beer_modal" data-id="">
                    <i class="fa-sharp fa-solid fa-trash pointer-events-none"></i>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-8 gap-2 items-start">
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Brewery</h4>
                <p class="beerBrewery"></p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Style</h4>
                <p class="style"></p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">IBU</h4>
                <p class="ibu"></p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">EBC</h4>
                <p class="ebc"></p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Volume</h4>
                <p class="volume"></p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Price</h4>
                <p class="price"></p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Active</h4>
                <p class="isActive"></p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Tapwall no.</h4>
                <p class="tapwallNo"></p>
            </div>
            <div class="col-span-5 xl:col-span-6 grid grid-cols-12 gap-2">
                <div class="col-span-12">
                    <h4 class="font-medium opacity-70 uppercase">Description</h4>
                    <p class="description"></p>
                </div>
                <div class="col-span-10 md:col-span-4 text-sm">
                    <h4 class="font-medium opacity-70 uppercase">Created at</h4>
                    <p class="createdAt"></p>
                </div>
                <div class="col-span-10 md:col-span-4 text-sm">
                    <h4 class="font-medium opacity-70 uppercase">Updated at</h4>
                    <p class="updatedAt"></p>
                </div>
            </div>
            <div class="col-span-3 xl:col-span-2 flex justify-end">
                <img class="" src="" alt="" />
            </div>
        </div>
    </article>
</template>