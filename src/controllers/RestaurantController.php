<?php

require_once 'AppController.php';


class RestaurantController extends AppController{

        public function addRestaurant(){

            $this->render('add-restaurant');
        }
}