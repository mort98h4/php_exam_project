<?php
include_once __DIR__ . '/../utils.php';
$beer = _getBeer($beer_id);
if (!$beer) _redirect('/404');
$title = $beer['beer_name'];
include_once __DIR__ . '/templates/header.php';
include_once __DIR__ . '/templates/nav.php';
?>

<main class="container mt-12 mx-auto p-4 grid grid-cols-12 gap-4">
    <header class="col-span-12 sm:col-start-3 sm:col-end-11 md:col-start-4 md:col-end-10">
        <h1 class="text-3xl font-medium">
            <?= out($beer['beer_name']) ?>
        </h1>
    </header>
    <section class="col-span-12 sm:col-start-3 sm:col-end-11 md:col-start-4 md:col-end-10 grid grid-cols-12 gap-2 items-start">
        <article class="col-span-8 grid grid-cols-12 gap-2 items">
            <div class="col-span-6 lg:col-span-4">
                <h2 class="font-medium opacity-70 uppercase text-xs md:text-sm">Brewery</h2>
                <p><?= out($beer['brewery_name']) ?></p>
            </div>
            <div class="col-span-6 lg:col-span-4">
                <h2 class="font-medium opacity-70 uppercase text-xs md:text-sm">Style</h2>
                <p><?= out($beer['beer_style']) ?></p>
            </div>
            
            <div class="col-span-3 lg:col-span-4">
            <?php if ($beer['beer_is_active']) { ?>
                <h2 class="font-medium opacity-70 uppercase text-xs md:text-sm">Tappwall No.</h2>
                <p><?= out($beer['beer_tapwall_no']) ?></p>
            <?php } ?>
            </div>
            <div class="col-span-3 lg:col-span-4 self-end">
                <h2 class="font-medium opacity-70 uppercase text-xs md:text-sm">IBU</h2>
                <p><?= out($beer['beer_ibu']) ?></p>
            </div>
            <div class="col-span-3 lg:col-span-4 self-end">
                <h2 class="font-medium opacity-70 uppercase text-xs md:text-sm">EBC</h2>
                <p><?= out($beer['beer_ebc']) ?></p>
            </div>
            <div class="col-span-3 lg:col-span-4 self-end">
                <h2 class="font-medium opacity-70 uppercase text-xs md:text-sm">Vol.</h2>
                <p><?= out($beer['beer_volume']) ?>%</p>
            </div>
            <div class="col-span-12">
                <h2 class="font-medium opacity-70 uppercase text-xs md:text-sm">Description</h2>
                <p><?= out($beer['beer_description']) ?></p>
            </div>
        </article>
        <div class="col-span-4 text-right">
            <!-- <h2 class="font-medium opacity-70 uppercase text-sm">Price</h2> -->
            <p class="text-7xl lg:text-9xl"><?= out($beer['beer_price']) ?><span class="text-base"> DKK</span></p>
            <?php if ($beer['beer_image']) { ?> 
                <img class="ml-auto" src="/public/images/uploads/<?= out($beer['beer_image']) ?>" alt="<?= out($beer['brewery_name']) ?> <?= out($beer['beer_name']) ?>" />
            <?php } ?>
        </div>
    </section>
    <div class="col-span-12 text-center pt-8">
        <a href="/tapwall" class="nav-link">
            <i class="fa-sharp fa-solid fa-arrow-left"></i>
            Back to Tapwall
        </a>
    </div>
</main>
<?php
include_once __DIR__ . '/templates/footer.php';