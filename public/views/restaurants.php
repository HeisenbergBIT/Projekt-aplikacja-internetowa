<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css"href="public/css/style.css">
    <link rel="stylesheet" type="text/css"href="public/css/restaurants.css">

    <script src="https://kit.fontawesome.com/a257307827.js" crossorigin="anonymous"></script>
    <title>RESTAURANTS</title>
</head>

<body>
    <div class="base-container">
        <nav>
            <img src="public/img/logo.svg">
            <ul>
                <li>
                    <i class="fas fa-utensils"></i>
                    <a href="#" class="button">restaurants</a>
                </li>
                <li>
                    <i class="fas fa-user-friends"></i>
                    <a href="#" class="button">people</a>
                </li>
                <li>
                    <i class="fas fa-comments"></i>
                    <a href="#" class="button">messages</a>
                </li>
                <li>
                    <i class="fas fa-bell"></i>
                    <a href="#" class="button">notification</a>
                </li>
                <li>
                    <i class="fas fa-cog"></i>
                    <a href="#" class="button">settings</a>
                </li>
            </ul>
        </nav>
        <main>
            <header>
                <div class="search-bar">
                    <form>
                        <input placeholder="search restaurant">
                    </form>
                    <div>
                        
                    </div>
                </div>
                <div class="add-restaurant">
                    <i class="fas fa-plus"></i>
                    add restaurant
                </div>

            </header>
            <section class="restaurants">
                <?php foreach($restaurants as $restaurant): ?>

                    <div class="restaurant">
                        <img src="public/uploads/<?= $restaurant->getImage(); ?>">
                        <div>
                            <h2><?= $restaurant->getTitle(); ?></h2>
                            <p><?= $restaurant->getDescription(); ?></p>
                            <div class="social-section">
                                <i class="fas fa-heart"> 600</i>
                                <i class="fas fa-minus-square"> 150</i>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
</body>