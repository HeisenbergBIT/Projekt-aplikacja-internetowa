<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Restaurant.php';

class RestaurantRepository extends Repository
{
    public function getRestaurant(int $id_restaurant): ?Restaurant
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM restaurants WHERE id_restaurant = :id_restaurant
        ');
        $stmt->bindParam(':id_restaurant', $id_restaurant, PDO::PARAM_INT);
        $stmt->execute();

        $restaurant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($restaurant == false) {
            return null;
        }

        return new Restaurant(
            $restaurant['title'],
            $restaurant['description'],
            $restaurant['image']
        );
    }

    public function addRestaurant(Restaurant $restaurant): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO restaurants (id_user, title, description, created_at, image)
            VALUES (?, ?, ?, ?, ?)
        ');
        $id_user = 1;

        $stmt->execute([
            $id_user,
            $restaurant->getTitle(),
            $restaurant->getDescription(),
            $date->format('Y-m-d'),
            $restaurant->getImage(),
        ]);
    }

    public function getRestaurants(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM restaurants;
        ');
        $stmt->execute();
        $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($restaurants as $restaurant) {
            $result[] = new Restaurant(
                $restaurant['title'],
                $restaurant['description'],
                $restaurant['image'],
                $restaurant['like'],
                $restaurant['dislike'],
                $restaurant['id_restaurant']
            );
        }

        return $result;
    }

    public function getRestaurantByTitle(string $searchString){

        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM restaurants WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE restaurants SET "like" = "like" + 1 WHERE id_restaurant = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function dislike(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE restaurants SET dislike = dislike + 1 WHERE id_restaurant = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}