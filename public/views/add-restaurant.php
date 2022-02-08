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
                </div>
                <div class="add-restaurant">
                    <i class="fas fa-plus"></i>
                    add restaurant
                </div>
            </header>
            <section class="restaurant-form">
                <h1>UPLOAD</h1>
                <form action="addRestaurant" method="POST" enctype="multipart/form-data">
                    <?php if(isset($messages)){
                        foreach ($messages as $message)
                            echo $message;
                    }
                    ?>
                    <input name="title", type="text" placeholder="title" required>
                    <textarea name="description" rows=5 placeholder="description"></textarea>
                    <input type="file" name="file" required>
                    <button type="submit">send</button>
                </form>
            </section>
        </main>
    </div>
</body>