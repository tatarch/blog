<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\System\Url;
use App\Views\View;
use App\System\Auth;

class UsersController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function form(): void
    {
        $user = Auth::getUser();
        // if (!Auth::getUser())
        if ($user == null) {
            View::render('registration', []);
        } else {
            header('Location: ' . Url::getRoot() . '/home/default');
            die();
        }
    }

    public function loginForm(): void
    {
        $user = Auth::getUser();
        // if (!Auth::getUser())
        if ($user == null) {
            View::render('login', []);
        } else {
            header('Location: ' . Url::getRoot() . '/home/default');
            die();
        }
    }

    public function save(): void
    {
        $email = $_POST['useremail'];
        $name = $_POST['username'];
        $password = $_POST['userpassword'];
        $this->userRepository->addUser($email, $name, $password);

        header('Location: ' . Url::getRoot() . '/users/loginForm');
        die();
    }

    public function login(): void
    {
        // а если не были переданные эти данные? будет ноутис
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        $user = $this->userRepository->getByNamePassword($email, $password);

        if ($user) {
            $_SESSION['userId'] = $user['id'];
            header('Location: ' . Url::getRoot() . '/home/default');
            die();
        } else {
            echo 'Wrong email or password';
            View::render('login', []);
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: ' . Url::getRoot() . '/home/default');
        // почему везде die() а тут exit? )
        exit;
    }
}
