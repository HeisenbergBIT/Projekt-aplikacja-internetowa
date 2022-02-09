<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Restaurant.php';
require_once __DIR__.'/../repository/RestaurantRepository.php';


class RestaurantController extends AppController{

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $restaurantRepository;

    public function __construct()
    {
        parent::__construct();
        $this->restaurantRepository = new RestaurantRepository();
    }

    public function restaurants()
    {
        $restaurants = $this->restaurantRepository->getRestaurants();
        /*echo var_dump($restaurants);*/
        $this->render('restaurants', ['restaurants' => $restaurants]);
    }


    public function addRestaurant(){

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $restaurant = new Restaurant($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->restaurantRepository->addRestaurant($restaurant);

            return $this->render('restaurants', [
                'messages' => $this->message,
                'restaurants' => $this->restaurantRepository->getRestaurants()
            ]);

            /*'restaurant' => $restaurant*/
        }

        return $this->render('add-restaurant', ['messages' => $this->messages]);
    }

    public function search(){

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->restaurantRepository->getRestaurantByTitle($decoded['search']));
        }
    }

    public function like(int $id) {
        $this->restaurantRepository->like($id);
        http_response_code(200);
    }

    public function dislike(int $id) {
        $this->restaurantRepository->dislike($id);
        http_response_code(200);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported';
            return false;
        }
        return true;
    }
}