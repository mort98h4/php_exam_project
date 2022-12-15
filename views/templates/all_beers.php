<?php
$beers = _getBeers()
?>

<div id="beers" class="w-full">
<?php foreach($beers as $beer) { ?>
    <article id="beer_<?= out($beer['beer_id']) ?>" class="beer">
        <header class="flex items-center justify-between">
            <h3 class="text-xl font-medium mb-2"><?= out($beer['beer_name']) ?></h3>
            <div>
                <button class="btn-icon mr-2" onclick="toggleUpdateModal()" data-target="#update_beer_modal" data-table="beers" data-id="<?= out($beer['beer_id']) ?>">
                    <i class="fa-sharp fa-solid fa-pen-to-square pointer-events-none"></i>
                </button>
                <button class="btn-icon text-red-600" onclick="toggleDeleteModal()" data-target="#delete_beer_modal" data-id="<?= out($beer['beer_id']) ?>">
                    <i class="fa-sharp fa-solid fa-trash pointer-events-none"></i>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-8 gap-2 items-start">
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Brewery</h4>
                <p class="beerBrewery">
                    <?= out($beer['brewery_name']) ?>
                </p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Style</h4>
                <p class="style">
                    <?= out($beer['beer_style']) ?>
                </p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">IBU</h4>
                <p class="ibu">
                    <?= $beer['beer_ibu'] ? out($beer['beer_ibu']) : '-' ?>
                </p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">EBC</h4>
                <p class="ebc">
                    <?= $beer['beer_ebc'] ? out($beer['beer_ebc']) : '-' ?>
                </p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Volume</h4>
                <p class="volume">
                    <?= out($beer['beer_volume']) ?>%
                </p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Price</h4>
                <p class="price">
                    <?= out($beer['beer_price']) ?> DKK
                </p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Active</h4>
                <p class="isActive">
                    <?= $beer['beer_is_active'] ? 'Yes' : 'No' ?>
                </p>
            </div>
            <div class="col-span-4 md:col-span-2">
                <h4 class="font-medium opacity-70 uppercase">Tapwall no.</h4>
                <p class="tapwallNo">
                    <?= $beer['beer_tapwall_no'] ? out($beer['beer_tapwall_no']) : '-' ?>
                </p>
            </div>
            <div class="col-span-5 xl:col-span-6 grid grid-cols-12 gap-2">
                <div class="col-span-12">
                    <h4 class="font-medium opacity-70 uppercase">Description</h4>
                    <p class="description">
                        <?= $beer['beer_description'] ? out($beer['beer_description']) : '-' ?>
                    </p>
                </div>
                <div class="col-span-10 md:col-span-4 text-sm">
                    <h4 class="font-medium opacity-70 uppercase">Created at</h4>
                    <p class="createdAt"><?= out(date('d/m/Y', intval($beer['beer_created_at']))) ?></p>
                </div>
                <div class="col-span-10 md:col-span-4 text-sm">
                    <h4 class="font-medium opacity-70 uppercase">Updated at</h4>
                    <p class="updatedAt">
                        <?= $beer['beer_updated_at'] ? out(date('d/m/Y', intval($beer['beer_updated_at']))) : '-' ?>
                    </p>
                </div>
            </div>
            <div class="col-span-3 xl:col-span-2 flex justify-end">
                <img class="<?= $beer['beer_image'] ? '' : 'hidden' ?>" src="./public/images/uploads/<?= out($beer['beer_image']) ?>" alt="<?= out($beer['brewery_name']) ?> <?= out($beer['beer_name']) ?>" />
            </div>
        </div>
    </article>
<?php } ?>
</div>
<?php if (count($beers) == 5) { ?>
<div class="w-full flex justify-center">
    <button class="btn my-4" onclick="getBeers()" data-offset="5">Load more</button>
</div>
<?php } ?>