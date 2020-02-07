<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\System\Url;
use App\Views\View;
use App\System\Auth;

class UsersController
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function form()
    {
        $user = Auth::getUser();
        if ($user == null) {
            View::render('registration', []);
        } else {
            header('Location: ' . Url::getRoot() . '/home/default');
            die();
        }
    }

    public function loginForm()
    {
        $user = Auth::getUser();
        if ($user == null) {
            View::render('login', []);
        } else {
            header('Location: ' . Url::getRoot() . '/home/default');
            die();
        }
    }

    public function save()
    {
        $email = $_POST['useremail'];
        $name = $_POST['username'];
        $password = $_POST['userpassword'];
        $this->userRepository->addUser($email, $name, $password);

        header('Location: ' . Url::getRoot() . '/users/loginForm');
        die();
    }

    public function login()
    {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        $user = $this->userRepository->getByNamePassword($email, $password);

        // а что если такой пользователь не найден?
        if ($user) {
            $_SESSION['userId'] = $user['id'];
            header('Location: ' . Url::getRoot() . '/home/default');
            die();
        }else{
            echo 'Wrong email or password';
            View::render('login', []);
        }

    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . Url::getRoot() . '/home/default');
        exit;
    }

}
