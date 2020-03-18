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
        if (!Auth::getUser()) {
            View::render('registration', [], 'login');
        } else {
            header('Location: ' . Url::getRoot() . '/home/default');
            die();
        }
    }

    public function loginForm(): void
    {
        if (!Auth::getUser()) {
            View::render('login', [], 'login');
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
        if (!$email || !$name || !$password){
            echo 'Fill in all form fields';
            View::render('registration', [], 'login');
            die();
        }
        $user = $this->userRepository->getByEmail($email);
        if ($user){
            echo 'This email is already registered';
            View::render('registration', [], 'login');
            die();
        }
        $hash=password_hash($password, PASSWORD_DEFAULT);
        $this->userRepository->addUser($email, $name, $hash);

        header('Location: ' . Url::getRoot() . '/users/loginForm');
        die();
    }

    public function login(): void
    {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        if (!$email || !$password){
            echo 'Fill in all form fields';
            View::render('login', [], 'login');
            die();
        }
        $user = $this->userRepository->getByEmail($email);

        if (password_verify($password, $user['password'])) {
            $_SESSION['userId'] = $user['id'];
            header('Location: ' . Url::getRoot() . '/home/default');
            die();
        } else {
            echo 'Wrong email or password';
            View::render('login', [], 'login');
            die();
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: ' . Url::getRoot() . '/home/default');
        die();
    }
}
