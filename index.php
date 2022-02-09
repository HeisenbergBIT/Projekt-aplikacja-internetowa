<?php

require 'Rooting.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('restaurants', 'RestaurantController');
Routing::post('login', 'SecurityController');
Routing::post('addRestaurant', 'RestaurantController');
Routing::post('register', 'SecurityController');
Routing::post('search', 'RestaurantController');
Routing::get('like', 'RestaurantController');
Routing::get('dislike', 'RestaurantController');

Routing::run($path);