<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css"href="public/css/style.css">
    <link rel="stylesheet" type="text/css"href="public/css/restaurants.css">

    <script src="https://kit.fontawesome.com/a257307827.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/statistics.js" defer></script>
    <title>RESTAURANTS</title>
</head>

<body>
    <div class="base-container">
        <nav>
            <img src="public/img/logo.svg">
            <ul>
                <li>
                    <i class="fas fa-utensils"></i>
                    <a href="/restaurants" class="button">restaurants</a>
                </li>
                <li>
                    <i class="fas fa-cog"></i>
                    <a href="/logout" class="button">log out</a>
                </li>
            </ul>
        </nav>
        <main>
            <header>
                <div class="search-bar">
                    <input placeholder="search restaurant">
                </div>
                <a class="add-restaurant" href="/addRestaurant">
<!--                    <div class="add-restaurant">-->
                        <i class="fas fa-plus"></i>
                        add restaurant

                </a>


            </header>
            <section class="restaurants">
                <?php foreach($restaurants as $restaurant): ?>
                    <div id="<?= $restaurant->getId(); ?>">
                        <img src="public/uploads/<?= $restaurant->getImage(); ?>">
                        <div>
                            <h2><?= $restaurant->getTitle(); ?></h2>
                            <p><?= $restaurant->getDescription(); ?></p>
                            <div class="social-section">
                                <i class="fas fa-heart"><?= $restaurant->getLike(); ?></i>
                                <i class="fas fa-minus-square"><?= $restaurant->getDislike(); ?></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
</body>

<template id="restaurant-template">
    <div id="">
        <img src="">
        <div>
            <h2>title</h2>
            <p>description</p>
            <div class="social-section">
                <i class="fas fa-heart"> 0</i>
                <i class="fas fa-minus-square"> 0</i>
            </div>
        </div>
    </div>
</template>