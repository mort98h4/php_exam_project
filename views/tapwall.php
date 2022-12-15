<?php

$title = 'Tapwall';
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';

$beers = _getTapwall();

?> 
<main class="container mx-auto md:p-4 mt-12 grid grid-cols-12">
    <div class="tapwall">
        <div class="row-span-1 col-span-12 text-center border-b border-b-white p-4 pb-0 pt-8">
            <h1 class="text-3xl font-medium font-pixel">Tapwall</h1>
        </div>
        <div class="row font-medium ">
            <div class="col-span-1 font-pixel text-2xs md:text-xs text-cyan">
                Tap
            </div>
            <div class="col-span-2 font-pixel text-2xs md:text-xs text-yellow">
                Style
            </div>
            <div class="col-span-3 md:col-span-3 font-pixel text-2xs md:text-xs text-orange-400">
                Name
            </div>
            <div class="col-span-2 font-pixel text-2xs md:text-xs text-orange-400">
                Brewery
            </div>
            <div class="col-span-1 font-pixel text-2xs md:text-xs">
                EBC
            </div>
            <div class="col-span-1 font-pixel text-2xs md:text-xs">
                IBU
            </div>
            <div class="col-span-1 font-pixel text-2xs md:text-xs text-green">
                Alc.%
            </div>
            <div class="col-span-1 md:col-span-1 font-pixel text-2xs md:text-xs text-yellow">
                DKK
            </div>
        </div>
        <?php 
        foreach($beers as $beer) { 
            if ($beer['beer_tapwall_no'] <= 26 ) {    
        ?>

            <a href="/tap/<?= out($beer['beer_id']) ?>" id="beer_<?= out($beer['beer_id']) ?>" class="row text-black font-medium">
                <div class="col-span-1 bg-gray-300 text-sm md:text-base">
                    <?= out($beer['beer_tapwall_no']) ?>
                </div>
                <div class="col-span-2 bg-yellow text-sm md:text-base">
                    <?= out($beer['beer_style']) ?>
                </div>
                <div class="col-span-3 md:col-span-3 bg-cyan text-sm md:text-base">
                    <?= out($beer['beer_name']) ?>
                </div>
                <div class="col-span-2 bg-green text-sm md:text-base">
                    <?= out($beer['brewery_name']) ?>
                </div>
                <div class="col-span-1 bg-magenta text-white text-sm md:text-base">
                    <?= out(intval($beer['beer_ebc']) ? $beer['beer_ebc'] : '-') ?>
                </div>
                <div class="col-span-1 bg-red text-white text-sm md:text-base">
                    <?= out(intval($beer['beer_ibu']) ? $beer['beer_ibu'] : '-') ?>
                </div>
                <div class="col-span-1 bg-blue text-white text-sm md:text-base">
                    <?= out($beer['beer_volume']) ?>%
                </div>
                <div class="col-span-1 md:col-span-1 bg-gray-300 lowercase text-sm md:text-base">
                    <?= out($beer['beer_price']) ?> kr.
                </div>
            </a>
        <?php 
            }
        }
        ?>
        <div class="col-span-12 bg-gray-300 grid grid-cols-12 border border-white border-t-0">
            <div class="col-span-3 bg-gray-400 text-center flex flex-wrap justify-center items-center p-2">
                <div class="w-full">
                    <p class="inline-block font-pixel md:text-lg text-red bg-black p-1 mb-1">Off</p>
                </div>
                <div class="w-full">
                    <p class="inline-block font-pixel md:text-lg text-red bg-black p-1 mb-1">the</p>
                </div>
                <div class="w-full">
                    <p class="inline-block font-pixel md:text-lg text-red bg-black p-1">wall</p>
                </div>
            </div>
            <div class="col-span-9 grid grid-cols-9">
                <?php 
                foreach($beers as $beer) {
                    if ($beer['beer_tapwall_no'] >= 27) {
                ?>
                <a href="/tap/<?= out($beer['beer_id']) ?>" class="row text-black font-medium px-2 py-4 items-center ">
                    <div class="col-span-12 text-left flex justify-between">
                        <div class="text-sm md:text-base">
                            <?php if ($beer['brewery_name'] !== $beer['beer_name']) { ?>
                            <?= out($beer['brewery_name']) ?>
                            <?php } ?>
                            <?= out($beer['beer_name']) ?>
                            -
                            EBC: <?= out($beer['beer_ebc']) ?>
                            -
                            IBU: <?= out($beer['beer_ibu']) ?>
                            -
                            Alc.: <?= out($beer['beer_volume']) ?>%
                        </div>
                        <div class="lowercase text-sm md:text-base">
                            <?= out($beer['beer_price']) ?> kr.
                        </div>
                    </div>
                </a>
                <?php        
                    }
                }
                ?>
            </div>
        </div>
    </div>
    
</main>

<?php
include_once __DIR__ . '/templates/modal_login.php';
include_once __DIR__ . '/templates/footer.php';