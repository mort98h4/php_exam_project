<?php 
$breweries = _getBreweries();
?>

<div id="breweries" class="w-full">
<?php foreach($breweries as $brewery) { ?>
    <article id="brewery_<?= out($brewery['brewery_id']) ?>" class="brewery">
        <header class="flex items-center justify-between">
            <h3 class="text-xl font-medium mb-2"><?= out($brewery['brewery_name']) ?></h3>
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
<?php } ?>
</div>
<?php
if (count($breweries) == 10) {
?>
<div class="w-full flex justify-center">
    <button class="btn" onclick="getBreweries()" data-offset="10">Load more</button>
</div>
<?php
} 
?>