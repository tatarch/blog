<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\UserRepository;
use App\Views\View;

class UsersController
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function form()
    {
        View::render('registration', []);
    }

    public function loginForm()
    {
        View::render('login', []);
    }

    public function save()
    {
        $email = $_POST['useremail'];
        $name = $_POST['username'];
        $password = $_POST['userpassword'];
        $this->userRepository->addUser($email, $name, $password);
        header('Location: http://blog.local/home/default');
        die;
    }

    public function login()
    {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        $user= $this->userRepository->getByNamePassword($email,$password);
        if(isset($user)){
            $_SESSION['userId']=$user['id'];
        }
        header('Location: http://blog.local/home/default');
        die;
    }
}