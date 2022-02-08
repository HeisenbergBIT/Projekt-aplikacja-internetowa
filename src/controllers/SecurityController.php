<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{

        public function login(){

            $userRepository = new UserRepository();

            if(!$this->isPost()){
                return $this->render('login');
            }

            $email = $_POST["email"];
            $password = $_POST["password"];

            $user = $userRepository->getUser($email);

            if(!$user){
                return $this->render('login',['messages' => ['User does not exist']]);
            }

            if($user->getEmail() !== $email){
                return $this->render('login',['messages' => ['User does not exist']]);
            }

            if($user->getPassword() !== $password){
                return $this->render('login',['messages' => ['Wrong password']]);
            }

            //return $this->render('restaurants');

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/restaurants");
        }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        //TODO try to use better hash function
        $user = new User($email, md5($password), $name, $surname);
        $user->setPhone($phone);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }
}